<?php

namespace Modules\Booking\Services;

use Modules\Booking\Repositories\Contracts\BookingInterface;
use Modules\Booking\Models\Booking;

class BookingService
{
    public function __construct(private BookingInterface $bookingInterface)
    {
    }

    /**
     * Create a new booking.
     *
     * @param array $data
     * @return \Modules\Booking\Models\Booking
     */
    public function createBooking(array $data): Booking
    {
        return $this->bookingInterface->create($data);
    }
}