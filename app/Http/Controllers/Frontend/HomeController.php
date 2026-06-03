<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\FashionCollection;
use App\Models\Gallery;
use App\Models\HomepageSetting;
use App\Models\Partner;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $setting = SiteSetting::query()->first();
        $homepage = HomepageSetting::current();

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

        $galleries = Gallery::query()
            ->active()
            ->featured()
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        $partners = Partner::query()
            ->active()
            ->featured()
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        $articles = Article::query()
            ->active()
            ->featured()
            ->published()
            ->orderBy('sort_order')
            ->latest('published_at')
            ->take(2)
            ->get();

        $testimonials = Testimonial::query()
            ->approved()
            ->featured()
            ->where('consent_to_publish', true)
            ->orderBy('sort_order')
            ->latest('approved_at')
            ->take(6)
            ->get();

        return view('pages.home', [
            'setting' => $setting,
            'homepage' => $homepage,
            'services' => $services,
            'collections' => $collections,
            'title' => $setting?->meta_title ?? 'Bendo Jaya Batik Fashion',
            'galleries' => $galleries,
            'partners' => $partners,
            'articles' => $articles,
            'testimonials' => $testimonials,
            'metaDescription' => $setting?->meta_description
                ?? 'Bendo Jaya Batik Fashion menghadirkan koleksi batik elegan, custom pakaian, dan kerja sama brand fashion.',
        ]);
    }
}
