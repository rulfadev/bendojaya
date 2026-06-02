@php
    $globalSetting = $setting ?? \App\Models\SiteSetting::query()->first();

    $siteName = $globalSetting?->site_name ?? 'Bendo Jaya';

    $navItems = [
        [
            'label' => 'Dashboard',
            'route' => 'admin.dashboard',
            'active' => 'admin.dashboard',
            'icon' => '◇',
        ],
        [
            'label' => 'Pengaturan Website',
            'route' => 'admin.site-settings.index',
            'active' => 'admin.site-settings.*',
            'icon' => '✦',
        ],
        [
            'label' => 'Layanan',
            'route' => 'admin.services.index',
            'active' => 'admin.services.*',
            'icon' => '✧',
        ],
        [
            'label' => 'Custom Page',
            'route' => 'admin.pages.index',
            'active' => 'admin.pages.*',
            'icon' => '✺',
        ],
        [
            'label' => 'Koleksi',
            'route' => 'admin.collections.index',
            'active' => 'admin.collections.*',
            'icon' => '✤',
        ],
        [
            'label' => 'Gallery',
            'route' => 'admin.galleries.index',
            'active' => 'admin.galleries.*',
            'icon' => '✹',
        ],
        [
            'label' => 'Profil Admin',
            'route' => 'admin.profile.edit',
            'active' => 'admin.profile.*',
            'icon' => '◈',
        ],
    ];

    $futureItems = ['Artikel', 'Partner / Kerja Sama', 'Pesan Kontak'];
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - {{ $siteName }}</title>

    @if ($globalSetting?->favicon)
        <link rel="icon" href="{{ asset('storage/' . $globalSetting->favicon) }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f8f2e8] text-stone-900 antialiased">
    <div class="pointer-events-none fixed inset-0 opacity-[0.06]"
        style="background-image: radial-gradient(circle at 1px 1px, #3b2415 1px, transparent 0); background-size: 22px 22px;">
    </div>

    <div class="relative min-h-screen">
        <aside
            class="fixed inset-y-0 left-0 z-30 hidden w-72 border-r border-stone-200/80 bg-[#fbf7ef]/95 backdrop-blur-xl lg:block">
            <div class="flex h-24 items-center border-b border-stone-200/80 px-7">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-900 text-xl font-bold text-amber-300 shadow-lg shadow-stone-900/10">
                        BJ
                    </div>
                    <div>
                        <h1 class="text-lg font-black tracking-tight text-stone-950">{{ $siteName }}</h1>
                        <p class="text-xs font-medium uppercase tracking-[0.25em] text-amber-700">CMS Batik</p>
                    </div>
                </div>
            </div>

            <div class="px-5 py-6">
                <div class="mb-6 rounded-3xl border border-amber-200/70 bg-amber-50/70 p-4">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-800">Admin Panel</p>
                    <p class="mt-2 text-sm leading-6 text-stone-600">
                        Kelola identitas, karya, koleksi, dan konten digital Bendo Jaya.
                    </p>
                </div>

                <nav class="space-y-1">
                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                            class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition
                           {{ request()->routeIs($item['active'])
                               ? 'bg-stone-950 text-amber-200 shadow-xl shadow-stone-900/10'
                               : 'text-stone-600 hover:bg-white hover:text-stone-950 hover:shadow-sm' }}">
                            <span class="text-lg">{{ $item['icon'] }}</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>

                <div class="mt-8">
                    <p class="px-4 text-xs font-black uppercase tracking-[0.25em] text-stone-400">Segera Dibuat</p>

                    <div class="mt-3 space-y-1">
                        @foreach ($futureItems as $item)
                            <div
                                class="flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-semibold text-stone-400">
                                <span>{{ $item }}</span>
                                <span
                                    class="rounded-full bg-stone-100 px-2 py-1 text-[10px] uppercase tracking-wider">Soon</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>

        <div class="lg:pl-72">
            <header class="sticky top-0 z-20 border-b border-stone-200/80 bg-[#fbf7ef]/90 backdrop-blur-xl">
                <div
                    class="flex min-h-20 flex-col gap-4 px-5 py-5 sm:flex-row sm:items-center sm:justify-between lg:px-8">
                    <div>
                        <p class="mb-1 text-xs font-black uppercase tracking-[0.25em] text-amber-700">Bendo Jaya Admin
                        </p>
                        <h2 class="text-2xl font-black tracking-tight text-stone-950">{{ $title ?? 'Dashboard' }}</h2>
                        <p class="mt-1 text-sm text-stone-500">{{ $subtitle ?? 'Kelola website Bendo Jaya.' }}</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" target="_blank"
                            class="rounded-2xl border border-stone-300 bg-white/70 px-4 py-2.5 text-sm font-bold text-stone-700 transition hover:border-stone-900 hover:text-stone-950">
                            Lihat Website
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="rounded-2xl bg-stone-950 px-4 py-2.5 text-sm font-bold text-amber-200 transition hover:bg-stone-800">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                <div class="flex gap-2 overflow-x-auto border-t border-stone-200/80 px-5 py-3 lg:hidden">
                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                            class="shrink-0 rounded-full px-4 py-2 text-xs font-bold
                           {{ request()->routeIs($item['active']) ? 'bg-stone-950 text-amber-200' : 'bg-white text-stone-600' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </header>

            <main class="px-5 py-8 lg:px-8">
                @if (session('success'))
                    <div
                        class="mb-6 rounded-3xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-3xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                        <div class="mb-2 font-black">Ada data yang perlu diperbaiki:</div>
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
