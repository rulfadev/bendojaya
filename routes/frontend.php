<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController as FrontendPageController;
use Illuminate\Support\Facades\Route;

Route::middleware('site.maintenance')->group(function () {
    Route::get('/pages/{page:slug}', [FrontendPageController::class, 'show'])
        ->name('pages.show');

    Route::get('/articles', [ArticleController::class, 'index'])
        ->name('articles.index');
    Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])
        ->name('articles.show');
});
