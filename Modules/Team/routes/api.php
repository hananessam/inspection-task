<?php

use Illuminate\Support\Facades\Route;
use Modules\Team\Http\Controllers\TeamAvailabilityController;
use Modules\Team\Http\Controllers\TeamController;

Route::middleware(['auth:sanctum', 'tenant'])->prefix('v1')->group(function () {
    Route::post('teams', [TeamController::class, 'store'])
        ->name('team.store');
    Route::get('teams', [TeamController::class, 'index'])
        ->name('team.index');

    // Team availability routes
    Route::post('teams/{team}/availabilities', [TeamAvailabilityController::class, 'storeAvailabilities'])
        ->name('team.availability.store');
});
