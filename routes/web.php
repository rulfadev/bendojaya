<?php

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('site.maintenance')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

require __DIR__.'/auth.php';
require __DIR__.'/frontend.php';
require __DIR__.'/seo.php';
require __DIR__.'/admin.php';
