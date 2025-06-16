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

    /**
     * Get bookings by user ID.
     *
     * @param int $userId
     * @return mixed
     */
    public function getByUserId(int $userId);
}