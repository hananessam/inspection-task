<?php

namespace Modules\Booking\Repositories\Elequent;

use Modules\Booking\Models\Booking;
use Modules\Booking\Repositories\Contracts\BookingInterface;

class BookingRepository implements BookingInterface
{
    /**
     * Create a new booking.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Booking
    {
        return Booking::create($data);
    }
}