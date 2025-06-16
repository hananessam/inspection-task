<?php

namespace Modules\Team\Repositories\Elequent;

use Modules\Team\Models\TeamAvailability;
use Modules\Team\Repositories\Contracts\TeamAvailabilityInterface;
use Illuminate\Database\Eloquent\Collection;

class TeamAvailabilityRepository implements TeamAvailabilityInterface
{
    /**
     * Register a new team availability.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): TeamAvailability
    {
        return TeamAvailability::create($data);
    }

    /**
     * Create multiple team availabilities.
     *
     * @param array $data
     * @return bool
     */
    public function createPluck(array $data): bool
    {
        return TeamAvailability::insert($data);
    }

    /**
     * Delete all team availabilities for a specific team ID.
     *
     * @param int $teamId
     * @return bool
     */
    public function deleteByTeamId(int $teamId): bool
    {
        return TeamAvailability::where('team_id', $teamId)->delete();
    }

    /**
     * Get all availabilities for a specific team.
     *
     * @param int $teamId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByTeamId(int $teamId): Collection
    {
        return TeamAvailability::where('team_id', $teamId)->get();
    }
}
