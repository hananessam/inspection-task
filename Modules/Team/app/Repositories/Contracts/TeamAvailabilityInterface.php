<?php

namespace Modules\Team\Repositories\Contracts;

use Modules\Team\Models\TeamAvailability;
use Illuminate\Database\Eloquent\Collection;

interface TeamAvailabilityInterface
{
    /**
     * Register a new team availability.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): TeamAvailability;

    /**
     * Create multiple team availabilities.
     *
     * @param array $data
     * @return bool
     */
    public function createPluck(array $data): bool;

    /**
     * Delete all team availabilities by team ID.
     *
     * @param int $teamId
     * @return bool
     */
    public function deleteByTeamId(int $teamId): bool;

    /**
     * Get all availabilities for a specific team.
     *
     * @param int $teamId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByTeamId(int $teamId): Collection;
}
