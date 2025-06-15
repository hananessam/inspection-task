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
}