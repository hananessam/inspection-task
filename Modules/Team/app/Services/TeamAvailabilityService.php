<?php

namespace Modules\Team\Services;

use DB;
use Modules\Team\Repositories\Contracts\TeamAvailabilityInterface;
use Modules\Team\Enums\DayOfWeekEnum;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Modules\Booking\Repositories\Contracts\BookingInterface;

class TeamAvailabilityService
{
    public function __construct(private TeamAvailabilityInterface $teamAvailabilityInterface, private BookingInterface $bookingInterface)
    {
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
        $groupedAvailabilities = $this->getGroupedAvailabilitiesByDay($teamId);
        if ($groupedAvailabilities->isEmpty()) {
            return [];
        }

        $bookedSlots = $this->bookingInterface->getByTeamId($teamId, $from, $to);
        $availableSlots = [];

        foreach (CarbonPeriod::create($from, $to) as $date) {
            $dayOfWeek = $date->dayOfWeek;
            $dailyAvailabilities = $groupedAvailabilities[$dayOfWeek] ?? [];

            foreach ($dailyAvailabilities as $availability) {
                $availableSlots = array_merge(
                    $availableSlots,
                    $this->generateDailySlots($availability, $date, $bookedSlots)
                );
            }
        }

        return $availableSlots;
    }

    private function getGroupedAvailabilitiesByDay(int $teamId): \Illuminate\Support\Collection
    {
        return $this->teamAvailabilityInterface
            ->getByTeamId($teamId)
            ->groupBy('day_of_week');
    }

    private function generateDailySlots($availability, Carbon $date, $bookedSlots): array
    {
        $slots = [];

        $startTime = Carbon::createFromTimeString($availability->start_time)->setDateFrom($date);
        $endTime = Carbon::createFromTimeString($availability->end_time)->setDateFrom($date);

        while ($startTime->lt($endTime)) {
            $slotEnd = $startTime->copy()->addHour();

            if (!$this->isSlotBooked($startTime, $slotEnd, $bookedSlots)) {
                $slots[] = [
                    'date' => $startTime->toDateString(),
                    'start_time' => $startTime->format('H:i'),
                    'end_time' => $slotEnd->format('H:i'),
                ];
            }

            $startTime->addHour();
        }

        return $slots;
    }

    private function isSlotBooked(Carbon $start, Carbon $end, $bookedSlots): bool
    {
        return $bookedSlots
            ->where('date', $start->format('Y-m-d'))
            ->where('start_time', $start->format('H:i:s'))
            ->where('end_time', $end->format('H:i:s'))
            ->isNotEmpty();
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