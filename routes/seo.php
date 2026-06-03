<?php

use App\Models\Article;
use App\Models\Faq;
use App\Models\FashionCollection;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\SeoSetting;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::get('/robots.txt', function () {
    $seo = SeoSetting::current();

    $content = "User-agent: *\n";

    if ($seo->allow_indexing) {
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /login\n";
        $content .= "Disallow: /logout\n";
    } else {
        $content .= "Disallow: /\n";
    }

    if ($seo->robots_extra_rules) {
        $content .= "\n".trim($seo->robots_extra_rules)."\n";
    }

    if ($seo->enable_sitemap) {
        $content .= "\nSitemap: ".route('seo.sitemap')."\n";
    }

    return response($content, 200)
        ->header('Content-Type', 'text/plain');
})->name('seo.robots');

Route::get('/sitemap.xml', function () {
    $seo = SeoSetting::current();

    abort_unless($seo->enable_sitemap, 404);

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

    $articles = Article::query()
        ->active()
        ->orderByDesc('published_at')
        ->get();

    $faqs = Faq::query()
        ->active()
        ->orderBy('sort_order')
        ->get();

    return response()
        ->view('seo.sitemap', [
            'pages' => $pages,
            'collections' => $collections,
            'galleries' => $galleries,
            'articles' => $articles,
            'faqs' => $faqs,
        ], 200)
        ->header('Content-Type', 'application/xml');
})->name('seo.sitemap');

Route::get('/llms.txt', function () {
    $seo = SeoSetting::current();

    abort_unless($seo->enable_llms_txt, 404);

    if ($seo->llms_txt_content) {
        return response($seo->llms_txt_content, 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    $setting = SiteSetting::query()->first();

    $siteName = $seo->organization_name
        ?: ($setting?->site_name ?? 'Bendo Jaya Batik Fashion');

    $description = $seo->default_meta_description
        ?: ($setting?->site_description
            ?? $setting?->short_description
            ?? 'Bendo Jaya Batik Fashion menghadirkan koleksi batik, custom pakaian, dan kerja sama brand fashion.');

    $pages = Page::query()
        ->active()
        ->orderBy('sort_order')
        ->get();

    $collections = FashionCollection::query()
        ->active()
        ->orderBy('sort_order')
        ->take(12)
        ->get();

    $articles = Article::query()
        ->active()
        ->orderByDesc('published_at')
        ->take(12)
        ->get();

    $content = "# {$siteName}\n\n";
    $content .= "> {$description}\n\n";

    $content .= "## Website\n\n";
    $content .= '- Homepage: '.url('/')."\n";
    $content .= '- Sitemap: '.route('seo.sitemap')."\n";
    $content .= '- Collections: '.route('collections.index')."\n";
    $content .= '- Gallery: '.route('galleries.index')."\n";
    $content .= '- Articles: '.route('articles.index')."\n";
    $content .= '- FAQ: '.route('faqs.index')."\n\n";

    $content .= "## Important Pages\n\n";

    foreach ($pages as $page) {
        $content .= "- {$page->title}: ".route('pages.show', $page)."\n";
    }

    if ($collections->isNotEmpty()) {
        $content .= "\n## Featured Collections\n\n";

        foreach ($collections as $collection) {
            $content .= "- {$collection->name}: ".route('collections.show', $collection)."\n";
        }
    }

    if ($articles->isNotEmpty()) {
        $content .= "\n## Articles\n\n";

        foreach ($articles as $article) {
            $content .= "- {$article->title}: ".route('articles.show', $article)."\n";
        }
    }

    $content .= "\n## Business Context\n\n";
    $content .= "Bendo Jaya is a batik fashion business focused on traditional-inspired clothing, fashion collections, custom uniforms, galleries, articles, and brand collaboration.\n";

    return response($content, 200)
        ->header('Content-Type', 'text/plain; charset=UTF-8');
})->name('seo.llms');
