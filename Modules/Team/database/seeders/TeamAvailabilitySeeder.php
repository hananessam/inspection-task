<?php

namespace Modules\Team\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Team\Enums\DayOfWeekEnum;
use Modules\Team\Models\Team;
use Modules\Team\Models\TeamAvailability;

class TeamAvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        $days = DayOfWeekEnum::cases();

        Team::all()->each(function ($team) use ($days) {
            foreach ($days as $day) {
                TeamAvailability::create([
                    'team_id' => $team->id,
                    'day_of_week' => $day,
                    'start_time' => '09:00',
                    'end_time' => '17:00',
                ]);
            }
        });
    }
}
