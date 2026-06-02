<?php

use App\Http\Controllers\PageController as FrontendPageController;
use Illuminate\Support\Facades\Route;

Route::middleware('site.maintenance')->group(function () {
    Route::get('/pages/{page:slug}', [FrontendPageController::class, 'show'])
        ->name('pages.show');
});
