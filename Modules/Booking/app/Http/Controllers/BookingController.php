<?php

namespace Modules\Booking\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Booking\Http\Requests\CreateBookingRequest;
use Modules\Booking\Services\BookingService;
use Modules\Booking\Transformers\BookingResource;
use Illuminate\Http\Request;

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

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function userBookings(Request $request)
    {
        $bookings = $this->bookingService->getBookingsByUserId(auth()->id());

        return response()->json([
            'data' => BookingResource::collection($bookings),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $booking)
    {
        $booking = $this->bookingService->getBookingsByUserId(auth()->id())
            ->findOrFail($booking);

        $this->bookingService->deleteById($booking->id);

        return response()->json([
            'message' => __('booking.deleted'),
        ]);
    }
}
