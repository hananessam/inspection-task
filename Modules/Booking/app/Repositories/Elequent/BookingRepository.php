<?php

namespace Modules\Booking\Repositories\Elequent;

use Modules\Booking\Models\Booking;
use Modules\Booking\Repositories\Contracts\BookingInterface;
use Carbon\Carbon;

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

    /**
     * Get bookings by user ID.
     *
     * @param int $userId
     * @return mixed
     */
    public function getByUserId(int $userId)
    {
        return Booking::where('user_id', $userId)->get();
    }

    /**
     * Delete a booking by ID.
     *
     * @param int $bookingId
     * @return mixed
     */
    public function delete(int $bookingId)
    {
        return Booking::destroy($bookingId);
    }

    /**
     * Get bookings by team ID.
     *
     * @param int $teamId
     * @param \Carbon\Carbon|null $from
     * @param \Carbon\Carbon|null $to
     * @return mixed
     */
    public function getByTeamId(int $teamId, Carbon|null $from = null, Carbon|null $to = null)
    {
        $query = Booking::where('team_id', $teamId);

        if ($from) {
            $query->where('date', '>=', $from);
        }

        if ($to) {
            $query->where('date', '<=', $to);
        }

        return $query->get();
    }
}