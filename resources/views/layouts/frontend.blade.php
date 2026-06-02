@php
    $siteName = $setting?->site_name ?? 'Bendo Jaya';
    $siteTagline = $setting?->tagline ?? 'Batik Fashion';
    $logo = $setting?->logo ? asset('storage/' . $setting->logo) : asset('assets/frontend/logo-bendo-jaya.jpg');

    $favicon = $setting?->favicon ? asset('storage/' . $setting->favicon) : null;
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? $siteName }}</title>
    <meta name="description"
        content="{{ $metaDescription ?? ($setting?->meta_description ?? 'Bendo Jaya Batik Fashion.') }}">

    @if ($favicon)
        <link rel="icon" href="{{ $favicon }}">
    @endif

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:600,700,800|plus-jakarta-sans:400,500,600,700,800"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FFF8ED] font-['Plus_Jakarta_Sans'] text-[#3C3B39] antialiased">
    <div class="pointer-events-none fixed inset-0 z-0 opacity-[0.035]"
        style="background-image: radial-gradient(circle at 1px 1px, #3C3B39 1px, transparent 0); background-size: 24px 24px;">
    </div>

    <div class="relative z-10">
        @include('partials.layout.navbar')

        <main>
            @yield('content')
        </main>

        @include('partials.layout.footer')
    </div>
    <script>
        document.addEventListener('click', function(event) {
            const link = event.target.closest(
                'a[href="#home"], a[href$="/#home"], a[href$="{{ route('home') }}#home"]');

            if (!link) {
                return;
            }

            const currentUrl = new URL(window.location.href);
            const targetUrl = new URL(link.href);

            const isSamePage =
                currentUrl.origin === targetUrl.origin &&
                currentUrl.pathname.replace(/\/$/, '') === targetUrl.pathname.replace(/\/$/, '');

            if (!isSamePage) {
                return;
            }

            event.preventDefault();

            history.replaceState(null, '', targetUrl.pathname + targetUrl.search);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>
