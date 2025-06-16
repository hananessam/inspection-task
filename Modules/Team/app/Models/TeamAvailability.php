<?php

namespace Modules\Team\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Team\Database\Factories\TeamAvailabilityFactory;
use Modules\Team\Enums\DayOfWeekEnum;

class TeamAvailability extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'day_of_week' => DayOfWeekEnum::class,
        'start_time' => 'time',
        'end_time' => 'time',
    ];
}
