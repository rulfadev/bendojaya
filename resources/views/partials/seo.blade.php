@php
    $seoMeta = \App\Support\SeoMeta::make([
        'title' => $title ?? null,
        'description' => $metaDescription ?? null,
        'keywords' => $metaKeywords ?? null,
        'image' => $ogImage ?? null,
        'canonical' => $canonicalUrl ?? null,
        'robots' => $robots ?? null,
        'type' => $ogType ?? null,
        'schema' => $schema ?? null,
    ]);

    $seoSetting = $seoMeta['seoSetting'];
@endphp

<title>{{ $seoMeta['title'] }}</title>

@if ($seoMeta['description'])
    <meta name="description" content="{{ $seoMeta['description'] }}">
@endif

@if ($seoMeta['keywords'])
    <meta name="keywords" content="{{ $seoMeta['keywords'] }}">
@endif

<meta name="robots" content="{{ $seoMeta['robots'] }}">
<link rel="canonical" href="{{ $seoMeta['canonical'] }}">

<meta property="og:title" content="{{ $seoMeta['title'] }}">
<meta property="og:type" content="{{ $seoMeta['type'] }}">
<meta property="og:url" content="{{ $seoMeta['canonical'] }}">

@if ($seoMeta['description'])
    <meta property="og:description" content="{{ $seoMeta['description'] }}">
@endif

@if ($seoMeta['image'])
    <meta property="og:image" content="{{ $seoMeta['image'] }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoMeta['title'] }}">

@if ($seoMeta['description'])
    <meta name="twitter:description" content="{{ $seoMeta['description'] }}">
@endif

@if ($seoMeta['image'])
    <meta name="twitter:image" content="{{ $seoMeta['image'] }}">
@endif

@if ($seoSetting->google_site_verification)
    <meta name="google-site-verification" content="{{ $seoSetting->google_site_verification }}">
@endif

@if ($seoSetting->bing_site_verification)
    <meta name="msvalidate.01" content="{{ $seoSetting->bing_site_verification }}">
@endif

@if ($seoSetting->enable_json_ld)
    <script type="application/ld+json">
        {!! json_encode(\App\Support\SeoMeta::organizationSchema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    <script type="application/ld+json">
        {!! json_encode(\App\Support\SeoMeta::websiteSchema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    @if ($seoMeta['schema'])
        <script type="application/ld+json">
            {!! json_encode($seoMeta['schema'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    @endif
@endif
