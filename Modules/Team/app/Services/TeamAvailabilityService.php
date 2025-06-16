<?php

namespace Modules\Team\Services;

use DB;
use Modules\Team\Repositories\Contracts\TeamAvailabilityInterface;
use Modules\Team\Enums\DayOfWeekEnum;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

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
     * Generate slots for a team's availability.
     *
     * @param int $teamId
     * @return array
     */
    public function generateSlots(int $teamId, Carbon $from, Carbon $to): array
    {
        $availabilities = $this->teamAvailabilityInterface->getByTeamId($teamId)->groupBy('day_of_week');

        if ($availabilities->isEmpty()) {
            return []; // No availabilities
        }

        $slots = [];
        foreach (CarbonPeriod::create($from, $to) as $date) {
            $day = $date->dayOfWeek;
            $slotsForDay = $availabilities[$day] ?? [];

            foreach ($slotsForDay as $slot) {
                $start = Carbon::createFromTimeString($slot->start_time)->setDateFrom($date);
                $end   = Carbon::createFromTimeString($slot->end_time)->setDateFrom($date);
    
                while ($start->lt($end)) {
                    $slotStart = $start->copy();
                    $slotEnd   = $start->copy()->addHour();
    
                    $slots[] = [
                        'date' => $slotStart->toDateString(),
                        'start_time' => $slotStart->format('H:i'),
                        'end_time' => $slotEnd->format('H:i'),
                    ];
    
                    $start->addHour();
                }
            }
        }
        return $slots;
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