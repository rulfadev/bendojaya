<?php

namespace App\Support;

use App\Models\SeoSetting;
use App\Models\SiteSetting;

class SeoMeta
{
    public static function make(array $data = []): array
    {
        $seo = SeoSetting::current();
        $site = SiteSetting::query()->first();

        $title = $data['title']
            ?? $seo->default_meta_title
            ?? $site?->meta_title
            ?? config('app.name');

        $description = $data['description']
            ?? $seo->default_meta_description
            ?? $site?->meta_description
            ?? null;

        $keywords = $data['keywords']
            ?? $seo->default_meta_keywords
            ?? $site?->meta_keywords
            ?? null;

        $image = $data['image']
            ?? ($seo->default_og_image ? asset('storage/'.$seo->default_og_image) : null)
            ?? ($site?->og_image ? asset('storage/'.$site->og_image) : null);

        $canonical = $data['canonical']
            ?? self::canonicalUrl($seo);

        $robots = $data['robots']
            ?? ($seo->allow_indexing ? 'index, follow' : 'noindex, nofollow');

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'image' => $image,
            'canonical' => $canonical,
            'robots' => $robots,
            'type' => $data['type'] ?? 'website',
            'schema' => $data['schema'] ?? null,
            'seoSetting' => $seo,
        ];
    }

    public static function canonicalUrl(?SeoSetting $seo = null): string
    {
        $seo ??= SeoSetting::current();

        if ($seo->canonical_base_url) {
            return rtrim($seo->canonical_base_url, '/').request()->getRequestUri();
        }

        return url()->current();
    }

    public static function organizationSchema(): array
    {
        $seo = SeoSetting::current();
        $site = SiteSetting::query()->first();

        $sameAs = collect([
            $seo->same_as_instagram ?: $site?->instagram_url,
            $seo->same_as_tiktok ?: $site?->tiktok_url,
        ])->filter()->values()->all();

        return array_filter([
            '@context' => 'https://schema.org',
            '@type' => $seo->organization_type ?: 'Organization',
            'name' => $seo->organization_name ?: $site?->site_name ?: config('app.name'),
            'url' => route('home'),
            'logo' => $seo->organization_logo ? asset('storage/'.$seo->organization_logo) : ($site?->logo ? asset('storage/'.$site->logo) : null),
            'sameAs' => $sameAs ?: null,
        ]);
    }

    public static function websiteSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => SeoSetting::current()->organization_name ?: config('app.name'),
            'url' => route('home'),
        ];
    }
}
