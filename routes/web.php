<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $setting = SiteSetting::query()->first();

    return view('pages.home', [
        'setting' => $setting,
        'title' => $setting?->meta_title ?? 'Bendo Jaya Batik Fashion',
        'metaDescription' => $setting?->meta_description ?? 'Bendo Jaya Batik Fashion menghadirkan koleksi batik elegan, custom pakaian, dan kerja sama brand fashion.',
    ]);
})->name('home');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('admin.logout');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::redirect('/', '/admin/dashboard')->name('home');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/site-settings', [SiteSettingController::class, 'index'])
            ->name('site-settings.index');

        Route::put('/site-settings', [SiteSettingController::class, 'update'])
            ->name('site-settings.update');
    });
