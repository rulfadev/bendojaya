<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BackupExportController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FashionCollectionController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomepageSettingController;
use App\Http\Controllers\Admin\MediaAssetController;
use App\Http\Controllers\Admin\NavigationMenuController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SeoSettingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WhatsappTemplateController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'panel'])
    ->group(function () {
        Route::redirect('/', '/admin/dashboard')->name('home');

        Route::middleware('role:admin,editor,staff')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');

            Route::get('/profile', [ProfileController::class, 'edit'])
                ->name('profile.edit');
            Route::put('/profile', [ProfileController::class, 'update'])
                ->name('profile.update');

            Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
                ->name('profile.password.update');

            Route::get('/contact-messages', [ContactMessageController::class, 'index'])
                ->name('contact-messages.index');
            Route::get('/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])
                ->name('contact-messages.show');
            Route::patch('/contact-messages/{contactMessage}/read', [ContactMessageController::class, 'markAsRead'])
                ->name('contact-messages.read');
            Route::patch('/contact-messages/{contactMessage}/status', [ContactMessageController::class, 'updateStatus'])
                ->name('contact-messages.status');
            Route::delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])
                ->name('contact-messages.destroy');

            Route::resource('testimonials', TestimonialController::class)
                ->except(['show']);
            Route::patch('/testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])
                ->name('testimonials.approve');
        });

        Route::middleware('role:admin,editor')->group(function () {
            Route::resource('articles', ArticleController::class)
                ->except(['show']);

            Route::resource('pages', AdminPageController::class)
                ->except(['show']);
            Route::prefix('pages/{page}')
                ->name('pages.')
                ->group(function () {
                    Route::resource('sections', PageSectionController::class)
                        ->except(['show']);
                });

            Route::resource('collections', FashionCollectionController::class)
                ->parameters([
                    'collections' => 'collection',
                ])
                ->except(['show']);

            Route::resource('galleries', GalleryController::class)
                ->except(['show']);

            Route::resource('services', ServiceController::class)
                ->except(['show']);

            Route::resource('partners', PartnerController::class)
                ->except(['show']);

            Route::get('/homepage-settings', [HomepageSettingController::class, 'edit'])
                ->name('homepage-settings.edit');
            Route::put('/homepage-settings', [HomepageSettingController::class, 'update'])
                ->name('homepage-settings.update');

            Route::resource('navigation-menus', NavigationMenuController::class)
                ->except(['show']);

            Route::resource('faqs', FaqController::class)
                ->except(['show']);

            Route::resource('media-assets', MediaAssetController::class)
                ->except(['show']);
        });

        Route::middleware('role:admin')->group(function () {
            Route::resource('users', UserController::class)
                ->except(['show']);

            Route::get('/site-settings', [SiteSettingController::class, 'index'])
                ->name('site-settings.index');
            Route::put('/site-settings', [SiteSettingController::class, 'update'])
                ->name('site-settings.update');

            Route::get('/backups', [BackupExportController::class, 'index'])
                ->name('backups.index');
            Route::get('/backups/export/{type}', [BackupExportController::class, 'export'])
                ->name('backups.export');

            Route::delete('/activity-logs/clear-old', [ActivityLogController::class, 'clearOld'])
                ->name('activity-logs.clear-old');
            Route::resource('activity-logs', ActivityLogController::class)
                ->only(['index', 'show', 'destroy']);

            Route::get('/seo-settings', [SeoSettingController::class, 'edit'])
                ->name('seo-settings.edit');
            Route::put('/seo-settings', [SeoSettingController::class, 'update'])
                ->name('seo-settings.update');

            Route::get('/whatsapp-templates', [WhatsappTemplateController::class, 'index'])
                ->name('whatsapp-templates.index');
            Route::put('/whatsapp-templates', [WhatsappTemplateController::class, 'update'])
                ->name('whatsapp-templates.update');
        });
    });
