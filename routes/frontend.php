<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CollectionInquiryController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FashionCollectionController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PageController as FrontendPageController;
use App\Http\Controllers\PartnershipInquiryController;
use App\Http\Controllers\QuotationPreviewController;
use App\Http\Controllers\TestimonialFormController;
use Illuminate\Support\Facades\Route;

Route::middleware('site.maintenance')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/pages/{page:slug}', [FrontendPageController::class, 'show'])
        ->name('pages.show');

    Route::get('/articles', [ArticleController::class, 'index'])
        ->name('articles.index');
    Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])
        ->name('articles.show');

    Route::post('/contact-messages', [ContactMessageController::class, 'store'])
        ->name('contact-messages.store');

    Route::get('/collections', [FashionCollectionController::class, 'index'])
        ->name('collections.index');
    Route::get('/collections/{collection:slug}', [FashionCollectionController::class, 'show'])
        ->name('collections.show');

    Route::get('/gallery', [GalleryController::class, 'index'])
        ->name('galleries.index');
    Route::get('/gallery/{gallery:slug}', [GalleryController::class, 'show'])
        ->name('galleries.show');

    Route::get('/testimonial-form/{testimonial:token}', [TestimonialFormController::class, 'show'])
        ->name('testimonial-form.show');
    Route::post('/testimonial-form/{testimonial:token}', [TestimonialFormController::class, 'submit'])
        ->name('testimonial-form.submit');
    Route::get('/testimonial-form/{testimonial:token}/thank-you', [TestimonialFormController::class, 'thankYou'])
        ->name('testimonial-form.thank-you');

    Route::get('/faq', [FaqController::class, 'index'])
        ->name('faqs.index');

    Route::post('/collections/{collection:slug}/inquiry', [CollectionInquiryController::class, 'store'])
        ->name('collections.inquiries.store');

    Route::post('/partnership-inquiries', [PartnershipInquiryController::class, 'store'])
        ->name('partnership-inquiries.store');

    Route::get('/quotations/{quotation}/preview/{token}', [QuotationPreviewController::class, 'show'])
        ->name('quotations.preview');
    Route::post('/quotations/{quotation}/preview/{token}/approve', [QuotationPreviewController::class, 'approve'])
        ->name('quotations.preview.approve');
    Route::post('/quotations/{quotation}/preview/{token}/reject', [QuotationPreviewController::class, 'reject'])
        ->name('quotations.preview.reject');
});
