<?php

namespace Modules\User\Repositories\Elequent;

use Modules\User\Models\User;
use Modules\User\Repositories\Contracts\UserInterface;

class UserRepository implements UserInterface
{
    /**
     * Register a new user.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Find a user by their email.
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email, $withTenant = false): ?User
    {
        $query = User::where('email', $email);

        if ($withTenant) {
            $query->with('tenant');
        }

        return $query->first();
    }
}