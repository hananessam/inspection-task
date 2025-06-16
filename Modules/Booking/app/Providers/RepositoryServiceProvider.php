<?php

namespace Modules\Booking\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Booking\Repositories\Elequent\BookingRepository;
use Modules\Booking\Repositories\Contracts\BookingInterface;
use Modules\Booking\Repositories\Elequent\BookingAvailabilityRepository;
use Modules\Booking\Repositories\Contracts\BookingAvailabilityInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->bind(BookingInterface::class, BookingRepository::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
