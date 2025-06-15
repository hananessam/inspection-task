<?php

use Illuminate\Support\Facades\Route;
use Modules\Team\Http\Controllers\TeamController;

Route::middleware(['auth:sanctum', 'tenant'])->prefix('v1')->group(function () {
    Route::post('teams', [TeamController::class, 'store'])
        ->name('team.store');
});
