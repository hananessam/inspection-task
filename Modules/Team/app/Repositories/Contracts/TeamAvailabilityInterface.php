<?php

namespace Modules\Team\Repositories\Contracts;

use Modules\Team\Models\TeamAvailability;

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
}