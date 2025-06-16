<?php

namespace Modules\Booking\Services;

use Modules\Booking\Repositories\Contracts\BookingInterface;
use Modules\Booking\Models\Booking;
use Carbon\Carbon;

class BookingService
{
    public function __construct(private BookingInterface $bookingInterface)
    {
    }

    /**
     * Create a new booking.
     *
     * @param array $data
     * @return ?\Modules\Booking\Models\Booking
     */
    public function createBooking(array $data): ?Booking
    {
        $date = Carbon::parse($data['date']);
        $startTime = Carbon::parse($data['start_time']);
        $endTime = Carbon::parse($data['end_time']);

        $bookedSlots = $this->bookingInterface->getByTeamId($data['team_id'], $date, $date);
        $isBooked = $bookedSlots
            ->where('date', $date->format('Y-m-d'))
            ->where('start_time', $startTime->format('H:i:s'))
            ->where('end_time', $endTime->format('H:i:s'))
            ->count();

        if ($isBooked) {
            return null; // Slot is already booked
        }

        return $this->bookingInterface->create($data);
    }

    /**
     * Get bookings by user ID.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBookingsByUserId(int $userId): \Illuminate\Database\Eloquent\Collection
    {
        return $this->bookingInterface->getByUserId($userId);
    }

    /**
     * Delete a booking by ID.
     *
     * @param int $bookingId
     * @return void
     */
    public function deleteById(int $bookingId): void
    {
        $this->bookingInterface->delete($bookingId);
    }
}