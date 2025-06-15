<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
        Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    });
});
