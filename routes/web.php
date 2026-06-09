<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware(SetLocale::class)->group(function () {
    require __DIR__.'/frontend.php';
    require __DIR__.'/seo.php';
});

Route::prefix('en')
    ->as('en.')
    ->middleware(SetLocale::class)
    ->group(function () {
        require __DIR__.'/frontend.php';
    });

require __DIR__.'/admin.php';
