<?php

namespace Modules\Team\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Team\Models\Team;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        Team::factory()->count(10)->create();
    }
}