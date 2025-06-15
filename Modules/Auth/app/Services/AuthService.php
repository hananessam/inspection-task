<?php

namespace Modules\Auth\Services;

use DB;
use Hash;
use Modules\User\Models\User;
use Modules\User\Repositories\Contracts\UserInterface;
use Modules\Tenant\Repositories\Contracts\TenantInterface;

class AuthService 
{
    public function __construct(private UserInterface $userInterface, private TenantInterface $tenantInterface)
    {
    }

    /**
     * Register a new user.
     *
     * @param array $data
     * @return mixed
     */
    public function register(array $data): User
    {
        $user = DB::transaction(function () use ($data) {
            if ($data['is_tenant']) {
                $tenant = $this->tenantInterface->create([
                    'name' => str($data['name'])->slug(),
                ]);
                
                $data['tenant_id'] = $tenant->id;
            }

            $user = $this->userInterface->create($data);

            return $user;
        });

        return $user;
    }

    /**
     * Login a user.
     *
     * @param array $data
     * @return array|null
     */
    public function login(array $data): ?array
    {
        $user = $this->userInterface->findByEmail($data['email'], true);

        if (!$this->isValidCredentials($user, $data['password'])) {
            return null;
        }

        $this->setTenantContext($user);

        return [
            'user' => $user,
            'token' => $this->generateAuthToken($user),
        ];
    }

    protected function isValidCredentials(?User $user, string $password): bool
    {
        return $user && Hash::check($password, $user->password);
    }

    protected function setTenantContext(User $user): void
    {
        $this->tenantInterface->forgetCurrent();
        if ($user->tenant) {
            $this->tenantInterface->setCurrent($user->tenant);
        }
    }

    protected function generateAuthToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}