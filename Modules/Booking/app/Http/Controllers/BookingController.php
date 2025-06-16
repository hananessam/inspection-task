<?php

namespace Modules\Booking\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Booking\Http\Requests\CreateBookingRequest;
use Modules\Booking\Services\BookingService;
use Modules\Booking\Transformers\BookingResource;

class BookingController extends Controller
{
    public function __construct(private BookingService $bookingService)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookingRequest $request) 
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = auth()->id();

        $booking = $this->bookingService->createBooking($validatedData);

        return response()->json([
            'message' => __('booking.created'),
        ], 201);
    }
}
