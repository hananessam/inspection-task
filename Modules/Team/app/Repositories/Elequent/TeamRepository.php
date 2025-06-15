<?php

namespace Modules\Team\Repositories\Elequent;

use Modules\Team\Models\Team;
use Modules\Team\Repositories\Contracts\TeamInterface;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * Get teams by tenant ID.
     *
     * @param int $tenantId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTeamsByTenantId(int $tenantId): Collection
    {
        return Team::where('tenant_id', $tenantId)->get();
    }
}