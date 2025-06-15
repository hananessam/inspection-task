<?php

namespace Modules\User\Repositories\Contracts;

use Modules\User\Models\User;

interface UserInterface
{
    /**
     * Register a new user.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): User;

    /**
     * Find a user by their email.
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email, bool $withTenant = false): ?User;
}