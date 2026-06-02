<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FashionCollectionController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'panel'])
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

        Route::resource('collections', FashionCollectionController::class)
            ->parameters([
                'collections' => 'collection',
            ])
            ->except(['show']);

        Route::resource('pages', AdminPageController::class)
            ->except(['show']);
        Route::prefix('pages/{page}')
            ->name('pages.')
            ->group(function () {
                Route::resource('sections', PageSectionController::class)
                    ->except(['show']);
            });

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
            ->name('profile.password.update');

        Route::resource('galleries', GalleryController::class)
            ->except(['show']);
    });
