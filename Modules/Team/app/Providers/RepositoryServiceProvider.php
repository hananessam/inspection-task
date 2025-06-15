<?php

namespace Modules\Team\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Team\Repositories\Elequent\TeamRepository;
use Modules\Team\Repositories\Contracts\TeamInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->bind(TeamInterface::class, TeamRepository::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
