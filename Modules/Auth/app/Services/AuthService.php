<?php

namespace Modules\Auth\Services;

use DB;
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
}