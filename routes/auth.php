<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/admin/login', fn () => redirect()->route('login'))
    ->name('admin.login');

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');
});
