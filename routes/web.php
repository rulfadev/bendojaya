<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\PageController as FrontendPageController;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $setting = SiteSetting::query()->first();

    $services = Service::query()
        ->active()
        ->featured()
        ->orderBy('sort_order')
        ->take(3)
        ->get();

    return view('pages.home', [
        'setting' => $setting,
        'services' => $services,
        'title' => $setting?->meta_title ?? 'Bendo Jaya Batik Fashion',
        'metaDescription' => $setting?->meta_description ?? 'Bendo Jaya Batik Fashion menghadirkan koleksi batik elegan, custom pakaian, dan kerja sama brand fashion.',
    ]);
})->name('home');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::get('/pages/{page:slug}', [FrontendPageController::class, 'show'])
    ->name('pages.show');

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

        Route::resource('services', ServiceController::class)
            ->except(['show']);
        Route::resource('pages', AdminPageController::class)
            ->except(['show']);

        Route::prefix('pages/{page}')
            ->name('pages.')
            ->group(function () {
                Route::resource('sections', PageSectionController::class)
                    ->except(['show']);
            });
    });
