<?php

namespace Modules\Team\Services;

use Modules\Team\Repositories\Contracts\TeamInterface;
use Modules\Team\Models\Team;
use Modules\Tenant\Repositories\Contracts\TenantInterface;
use Illuminate\Database\Eloquent\Collection;

class TeamService
{
    public function __construct(private TeamInterface $teamInterface, private TenantInterface $tenantInterface)
    {
    }

    /**
     * Create a new team.
     *
     * @param array $data
     * @return \Modules\Team\Models\Team
     */
    public function create(array $data, $tenantId = null): Team
    {
        $tenant = $tenantId ?? $this->tenantInterface->getCurrent();

        if (!$tenant) {
            throw new \Exception('tenant.not_found');
        }

        $data['tenant_id'] = $tenant->id;

        return $this->teamInterface->create($data);
    }

    /**
     * Get teams by tenant ID or current tenant.
     *
     * @param int|null $tenantId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTeamsByTenantId(int|null $tenantId = null): Collection
    {
        $tenantId ??= $this->tenantInterface->getCurrent()?->id;
        return $this->teamInterface->getTeamsByTenantId($tenantId);
    }

    /**
     * Get a team by its ID.
     *
     * @param int $id
     * @return \Modules\Team\Models\Team|null
     */
    public function getById(int $id): ?Team
    {
        return $this->teamInterface->getById($id);
    }

    /**
     * Check if a team belongs to the current tenant.
     *
     * @param \Modules\Team\Models\Team $team
     * @param int $tenantId
     * @return bool
     */
    public function checkIfTeamBelongsToTenant(Team $team, int $tenantId): bool
    {
        return $team->tenant_id === $tenantId;
    }
}