<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\FashionCollection;
use App\Models\Gallery;
use App\Models\HomepageSetting;
use App\Models\MediaAsset;
use App\Models\NavigationMenu;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Partner;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use App\Observers\ActivityLogObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $models = [
            Article::class,
            Page::class,
            PageSection::class,
            FashionCollection::class,
            Gallery::class,
            Service::class,
            Partner::class,
            Testimonial::class,
            ContactMessage::class,
            Faq::class,
            NavigationMenu::class,
            MediaAsset::class,
            HomepageSetting::class,
            SiteSetting::class,
            User::class,
        ];

        foreach ($models as $model) {
            if (class_exists($model)) {
                $model::observe(ActivityLogObserver::class);
            }
        }
    }
}
