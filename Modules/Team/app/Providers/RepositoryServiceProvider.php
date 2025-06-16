<?php

namespace Modules\Team\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Team\Repositories\Elequent\TeamRepository;
use Modules\Team\Repositories\Contracts\TeamInterface;
use Modules\Team\Repositories\Elequent\TeamAvailabilityRepository;
use Modules\Team\Repositories\Contracts\TeamAvailabilityInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->bind(TeamInterface::class, TeamRepository::class);
        $this->app->bind(TeamAvailabilityInterface::class, TeamAvailabilityRepository::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
