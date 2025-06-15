<?php

namespace Modules\Team\Repositories\Elequent;

use Modules\Team\Models\Team;
use Modules\Team\Repositories\Contracts\TeamInterface;

class TeamRepository implements TeamInterface
{
    /**
     * Register a new team.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Team
    {
        return Team::create($data);
    }
}