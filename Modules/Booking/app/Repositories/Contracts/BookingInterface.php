<?php

namespace Modules\Booking\Repositories\Contracts;

use Modules\Booking\Models\Booking;

interface BookingInterface
{
    /**
     * Create a new Booking.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Booking;
}