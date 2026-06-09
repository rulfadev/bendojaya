@php
    $siteName = $setting?->site_name ?? 'Bendo Jaya Batik Fashion';
    $title = $setting?->maintenance_title ?: __('frontend.maintenance_title');

    $description = $setting?->maintenance_description ?: __('frontend.maintenance_description');

    $logo = $setting?->logo ? asset('storage/' . $setting->logo) : asset('assets/frontend/logo-bendo-jaya.jpg');

    $image = $setting?->maintenance_image
        ? asset('storage/' . $setting->maintenance_image)
        : asset('assets/frontend/hero-product.jpg');
    $ogImage = $setting?->default_og_image ? asset('storage/' . $setting->default_og_image) : $image;

    $whatsapp = $setting?->whatsapp_number ?? '6280000000000';

    $robots = $setting?->allow_search_indexing ? 'index, follow' : 'noindex, nofollow';

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => ['LocalBusiness', 'ClothingStore'],
        '@id' => url('/#localbusiness'),
        'name' => $siteName,
        'url' => url('/'),
        'logo' => $logo,
        'description' => $description,
        'telephone' => '+' . $whatsapp,
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Kradenan, Gg. 4, RT.02/RW.08, Buaran, Kec. Pekalongan Sel.',
            'addressLocality' => 'Kota Pekalongan',
            'addressRegion' => 'Jawa Tengah',
            'postalCode' => '51132',
            'addressCountry' => 'ID',
        ],
        'areaServed' => ['Indonesia', 'Southeast Asia', 'Asia Pacific', 'International Market'],
        'availableLanguage' => ['Indonesian', 'English'],
    ];
@endphp

<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }}</title>

    <meta name="description" content="{{ $description }}">

    <meta name="robots" content="{{ $robots }}">

    <link rel="canonical" href="{{ url('/') }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}">

    <meta property="og:description" content="{{ $description }}">

    <meta property="og:url" content="{{ url('/') }}">

    <meta property="og:image" content="{{ $ogImage }}">

    <meta name="twitter:card" content="summary_large_image">

    <meta name="twitter:title" content="{{ $title }}">

    <meta name="twitter:description" content="{{ $description }}">

    <meta name="twitter:image" content="{{ $ogImage }}">

    @if ($setting?->google_site_verification)
        <meta name="google-site-verification" content="{{ $setting->google_site_verification }}">
    @endif

    @if ($setting?->bing_site_verification)
        <meta name="msvalidate.01" content="{{ $setting->bing_site_verification }}">
    @endif

    <script type="application/ld+json">

        {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}

    </script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:600,700,800|plus-jakarta-sans:400,500,600,700,800"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen bg-[#3C3B39] font-['Plus_Jakarta_Sans'] text-[#FBE9CB] antialiased">

    <main class="relative min-h-screen overflow-hidden">

        <div class="absolute inset-0 bg-cover bg-center opacity-35"
            style="background-image: url('{{ $image }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#3C3B39] via-[#3C3B39]/90 to-[#3C3B39]/60"></div>

        <div class="absolute inset-0 opacity-[0.1]"
            style="background-image: radial-gradient(circle at 1px 1px, #FBE9CB 1px, transparent 0); background-size: 28px 28px;">

        </div>

        <section class="relative mx-auto flex min-h-screen max-w-7xl items-center px-5 py-12 lg:px-8">

            <div class="max-w-3xl">

                <img src="{{ $logo }}" alt="{{ $siteName }}" class="mb-10 h-16 w-auto object-contain">

                <p
                    class="mb-6 inline-flex rounded-full border border-[#FBE9CB]/25 bg-[#FBE9CB]/10 px-5 py-2 text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5] backdrop-blur">

                    {{ __('frontend.maintenance_badge') }}

                </p>

                <h1
                    class="font-['Playfair_Display'] text-5xl font-black leading-[1.05] tracking-tight sm:text-6xl lg:text-7xl">

                    {{ $title }}

                </h1>

                <p class="mt-7 max-w-2xl text-base leading-8 text-[#E6D8C8] sm:text-lg">

                    {{ $description }}

                </p>

                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex justify-center rounded-full bg-[#FBE9CB] px-8 py-4 text-sm font-black text-[#3C3B39] transition hover:bg-white">

                        {{ __('frontend.contact_whatsapp') }}

                    </a>

                    @if ($setting?->instagram_url)
                        <a href="{{ $setting->instagram_url }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex justify-center rounded-full border border-[#FBE9CB]/35 bg-white/5 px-8 py-4 text-sm font-black text-[#FBE9CB] backdrop-blur transition hover:bg-white/10">

                            {{ __('frontend.view_instagram') }}

                        </a>
                    @endif

                </div>

                <div class="mt-14 grid max-w-2xl gap-6 border-t border-[#FBE9CB]/20 pt-8 sm:grid-cols-3">

                    <div>

                        <p class="font-['Playfair_Display'] text-3xl font-black">
                            {{ __('frontend.maintenance_stat_1_title') }}</p>

                        <p class="mt-1 text-xs font-bold uppercase tracking-[0.2em] text-[#EEBDB5]">
                            {{ __('frontend.maintenance_stat_1_subtitle') }}</p>

                    </div>

                    <div>
                        <p class="font-['Playfair_Display'] text-3xl font-black">
                            {{ __('frontend.maintenance_stat_2_title') }}</p>

                        <p class="mt-1 text-xs font-bold uppercase tracking-[0.2em] text-[#EEBDB5]">
                            {{ __('frontend.maintenance_stat_2_subtitle') }}</p>

                    </div>

                    <div>

                        <p class="font-['Playfair_Display'] text-3xl font-black">
                            {{ __('frontend.maintenance_stat_3_title') }}</p>

                        <p class="mt-1 text-xs font-bold uppercase tracking-[0.2em] text-[#EEBDB5]">
                            {{ __('frontend.maintenance_stat_3_subtitle') }}</p>

                    </div>

                </div>

            </div>

        </section>

    </main>

</body>

</html>
