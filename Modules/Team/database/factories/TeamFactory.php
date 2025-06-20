<?php

namespace Modules\Team\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Team\Models\Team;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition(): array
    {
        return [
            'name' => 'Team ' . $this->faker->unique()->word(),
            'tenant_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
