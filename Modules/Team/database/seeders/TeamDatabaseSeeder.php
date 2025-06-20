<?php

namespace Modules\Team\Database\Seeders;

use Illuminate\Database\Seeder;

class TeamDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            TeamSeeder::class,
            TeamAvailabilitySeeder::class,
        ]);
    }
}
