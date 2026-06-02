<?php

use App\Models\FashionCollection;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::middleware('site.maintenance')->group(function () {
    Route::get('/', function () {
        $setting = SiteSetting::query()->first();

        $services = Service::query()
            ->active()
            ->featured()
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        $collections = FashionCollection::query()
            ->active()
            ->featured()
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('pages.home', [
            'setting' => $setting,
            'services' => $services,
            'collections' => $collections,
            'title' => $setting?->meta_title ?? 'Bendo Jaya Batik Fashion',
            'metaDescription' => $setting?->meta_description ?? 'Bendo Jaya Batik Fashion menghadirkan koleksi batik elegan, custom pakaian, dan kerja sama brand fashion.',
        ]);
    })->name('home');
});

require __DIR__.'/auth.php';
require __DIR__.'/frontend.php';
require __DIR__.'/seo.php';
require __DIR__.'/admin.php';
