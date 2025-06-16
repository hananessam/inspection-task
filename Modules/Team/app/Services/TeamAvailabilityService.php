<?php

namespace Modules\Team\Services;

use DB;
use Modules\Team\Repositories\Contracts\TeamAvailabilityInterface;
use Modules\Team\Enums\DayOfWeekEnum;

class TeamAvailabilityService
{
    public function __construct(private TeamAvailabilityInterface $teamAvailabilityInterface) {
    }

    /**
     * Create a new team availability.
     *
     * @param array $data
     * @param int $teamId
     * @param int|null $tenantId
     * @return bool
     */
    public function createPluck(array $data, int $teamId): bool
    {
        $availabilities = $this->customizeAvailabilities($data, $teamId);

        DB::transaction(function () use ($availabilities, $teamId) {
            // Delete existing availabilities for the team
            $this->teamAvailabilityInterface->deleteByTeamId($teamId);

            // Create new availabilities
            $this->teamAvailabilityInterface->createPluck($availabilities);
        });

        return true;
    }

    /**
     * Customize the availabilities data to include team ID and day of week.
     *
     * @param array $availabilities
     * @param int $teamId
     * @return array
     */
    protected function customizeAvailabilities(array $availabilities, int $teamId): array
    {
        return collect($availabilities)->map(function ($item) use ($teamId) {
            // Ensure day_of_week is an instance of DayOfWeekEnum
            if (!($item['day_of_week'] instanceof DayOfWeekEnum)) {
                $item['day_of_week'] = DayOfWeekEnum::tryFrom($item['day_of_week']);
            }
            return array_merge($item, ['team_id' => $teamId]);
        })->toArray();
    }
}