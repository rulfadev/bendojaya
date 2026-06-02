<?php

use App\Models\FashionCollection;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::get('/robots.txt', function () {
    $sitemapUrl = url('/sitemap.xml');

    $content = "User-agent: *\n";
    $content .= "Allow: /\n";
    $content .= "Disallow: /admin/\n";
    $content .= "Disallow: /login\n";
    $content .= "Disallow: /logout\n";
    $content .= "\nSitemap: {$sitemapUrl}\n";

    return response($content, 200)
        ->header('Content-Type', 'text/plain');
})->name('seo.robots');

Route::get('/sitemap.xml', function () {
    $pages = Page::query()
        ->active()
        ->orderBy('sort_order')
        ->get();

    $collections = FashionCollection::query()
        ->active()
        ->orderBy('sort_order')
        ->get();

    $galleries = Gallery::query()
        ->active()
        ->orderBy('sort_order')
        ->get();

    return response()
        ->view('seo.sitemap', [
            'pages' => $pages,
            'collections' => $collections,
            'galleries' => $galleries,
        ], 200)
        ->header('Content-Type', 'application/xml');
})->name('seo.sitemap');

Route::get('/llms.txt', function () {
    $setting = SiteSetting::query()->first();

    $siteName = $setting?->site_name ?? 'Bendo Jaya Batik Fashion';
    $description = $setting?->short_description
        ?? 'Bendo Jaya Batik Fashion menghadirkan koleksi batik, custom pakaian, dan kerja sama brand fashion.';

    $pages = Page::query()
        ->active()
        ->orderBy('sort_order')
        ->get();

    $content = "# {$siteName}\n\n";
    $content .= "> {$description}\n\n";
    $content .= "## Website\n\n";
    $content .= '- Homepage: '.url('/')."\n";
    $content .= '- Sitemap: '.url('/sitemap.xml')."\n\n";
    $content .= "## Important Pages\n\n";

    foreach ($pages as $page) {
        $content .= "- {$page->title}: ".route('pages.show', $page)."\n";
    }

    $content .= "\n## Business Context\n\n";
    $content .= "Bendo Jaya is a batik fashion business focused on traditional-inspired clothing, fashion collections, custom uniforms, galleries, articles, and brand collaboration.\n";

    return response($content, 200)
        ->header('Content-Type', 'text/plain');
})->name('seo.llms');
