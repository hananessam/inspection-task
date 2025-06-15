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
}