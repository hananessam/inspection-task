<?php

namespace Modules\Team\Repositories\Contracts;

use Modules\Team\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface TeamInterface
{
    /**
     * Register a new team.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Team;

    /**
     * Get teams by tenant ID.
     *
     * @param int $tenantId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTeamsByTenantId(int $tenantId): Collection;
}