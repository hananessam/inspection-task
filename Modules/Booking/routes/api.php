<?php

use Illuminate\Support\Facades\Route;
use Modules\Booking\Http\Controllers\BookingController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::post('bookings', [BookingController::class, 'store'])
        ->name('booking.store');
    Route::get('bookings', [BookingController::class, 'userBookings'])
        ->name('booking.userBookings');
    Route::delete('bookings/{booking}', [BookingController::class, 'destroy'])
        ->name('booking.destroy');
});
