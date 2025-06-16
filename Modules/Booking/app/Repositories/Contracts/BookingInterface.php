<?php

namespace Modules\Booking\Repositories\Contracts;

use Modules\Booking\Models\Booking;
use Carbon\Carbon;

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

    /**
     * Delete a booking by ID.
     *
     * @param int $bookingId
     * @return mixed
     */
    public function delete(int $bookingId);

    /**
     * Get bookings by team ID.
     *
     * @param int $teamId
     * @param \Carbon\Carbon|null $from
     * @param \Carbon\Carbon|null $to
     * @return mixed
     */
    public function getByTeamId(int $teamId, Carbon|null $from = null, Carbon|null $to = null);
}