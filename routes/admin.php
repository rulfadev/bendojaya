<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FashionCollectionController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomepageSettingController;
use App\Http\Controllers\Admin\NavigationMenuController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TestimonialController;
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

        Route::resource('partners', PartnerController::class)
            ->except(['show']);

        Route::resource('articles', ArticleController::class)
            ->except(['show']);

        Route::get('/contact-messages', [ContactMessageController::class, 'index'])
            ->name('contact-messages.index');

        Route::get('/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])
            ->name('contact-messages.show');
        Route::patch('/contact-messages/{contactMessage}/read', [ContactMessageController::class, 'markAsRead'])
            ->name('contact-messages.read');
        Route::delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])
            ->name('contact-messages.destroy');

        Route::resource('navigation-menus', NavigationMenuController::class)
            ->except(['show']);

        Route::resource('testimonials', TestimonialController::class)
            ->except(['show']);
        Route::patch('/testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])
            ->name('testimonials.approve');

        Route::get('/homepage-settings', [HomepageSettingController::class, 'edit'])
            ->name('homepage-settings.edit');
        Route::put('/homepage-settings', [HomepageSettingController::class, 'update'])
            ->name('homepage-settings.update');
    });
