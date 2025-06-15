<?php

namespace Modules\Team\Repositories\Contracts;

use Modules\Team\Models\Team;

interface TeamInterface
{
    /**
     * Register a new team.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Team;
}