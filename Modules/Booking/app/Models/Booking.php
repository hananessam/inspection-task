<?php

namespace Modules\Booking\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Booking\Database\Factories\BookingFactory;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'team_id',
        'date',
        'start_time',
        'end_time',
    ];

    // protected static function newFactory(): BookingFactory
    // {
    //     // return BookingFactory::new();
    // }
}
