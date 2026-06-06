@php
    $globalSetting = $setting ?? \App\Models\SiteSetting::query()->first();
    $siteName = $globalSetting?->site_name ?? 'Bendo Jaya';
    $currentUser = auth()->user();

    $newCollectionInquiriesCount = \App\Models\CollectionInquiry::query()->where('status', 'new')->count();

    $newPartnershipInquiriesCount = \App\Models\PartnershipInquiry::query()->where('status', 'new')->count();

    $notificationCount = \App\Models\AdminNotification::query()->whereNull('read_at')->count();

    $newCollectionInquiriesCount = \App\Models\CollectionInquiry::query()->where('status', 'new')->count();

    $newPartnershipInquiriesCount = \App\Models\PartnershipInquiry::query()->where('status', 'new')->count();

    $navSections = [
        [
            'label' => 'Utama',
            'items' => [
                [
                    'label' => 'Dashboard',
                    'route' => 'admin.dashboard',
                    'active' => 'admin.dashboard',
                    'icon' => 'fa-solid fa-chart-line',
                    'roles' => ['admin', 'editor', 'staff'],
                ],
                [
                    'label' => 'Notifikasi',
                    'route' => 'admin.notifications.index',
                    'active' => 'admin.notifications.*',
                    'icon' => 'fa-solid fa-bell',
                    'roles' => ['admin', 'editor', 'staff'],
                    'badge' => $notificationCount,
                ],
            ],
        ],

        [
            'label' => 'Lead & Penawaran',
            'items' => [
                [
                    'label' => 'Pesan Kontak',
                    'route' => 'admin.contact-messages.index',
                    'active' => 'admin.contact-messages.*',
                    'icon' => 'fa-solid fa-envelope-open-text',
                    'roles' => ['admin', 'editor', 'staff'],
                ],
                [
                    'label' => 'Inquiry Kerja Sama',
                    'route' => 'admin.partnership-inquiries.index',
                    'active' => 'admin.partnership-inquiries.*',
                    'icon' => 'fa-solid fa-handshake-angle',
                    'roles' => ['admin', 'editor', 'staff'],
                    'badge' => $newPartnershipInquiriesCount,
                ],
                [
                    'label' => 'Inquiry Koleksi',
                    'route' => 'admin.collection-inquiries.index',
                    'active' => 'admin.collection-inquiries.*',
                    'icon' => 'fa-solid fa-clipboard-question',
                    'roles' => ['admin', 'editor', 'staff'],
                    'badge' => $newCollectionInquiriesCount,
                ],
                [
                    'label' => 'Quotation',
                    'route' => 'admin.quotations.index',
                    'active' => 'admin.quotations.*',
                    'icon' => 'fa-solid fa-file-invoice-dollar',
                    'roles' => ['admin', 'editor'],
                ],
                [
                    'label' => 'Testimoni',
                    'route' => 'admin.testimonials.index',
                    'active' => 'admin.testimonials.*',
                    'icon' => 'fa-solid fa-star',
                    'roles' => ['admin', 'editor', 'staff'],
                ],
            ],
        ],

        [
            'label' => 'Konten Website',
            'items' => [
                [
                    'label' => 'Homepage',
                    'route' => 'admin.homepage-settings.edit',
                    'active' => 'admin.homepage-settings.*',
                    'icon' => 'fa-solid fa-house-laptop',
                    'roles' => ['admin', 'editor'],
                ],
                [
                    'label' => 'Menu Navigasi',
                    'route' => 'admin.navigation-menus.index',
                    'active' => 'admin.navigation-menus.*',
                    'icon' => 'fa-solid fa-bars-staggered',
                    'roles' => ['admin', 'editor'],
                ],
                [
                    'label' => 'Layanan',
                    'route' => 'admin.services.index',
                    'active' => 'admin.services.*',
                    'icon' => 'fa-solid fa-diamond',
                    'roles' => ['admin', 'editor'],
                ],
                [
                    'label' => 'Koleksi',
                    'route' => 'admin.collections.index',
                    'active' => 'admin.collections.*',
                    'icon' => 'fa-solid fa-shirt',
                    'roles' => ['admin', 'editor'],
                ],
                [
                    'label' => 'Gallery',
                    'route' => 'admin.galleries.index',
                    'active' => 'admin.galleries.*',
                    'icon' => 'fa-solid fa-images',
                    'roles' => ['admin', 'editor'],
                ],
                [
                    'label' => 'Artikel',
                    'route' => 'admin.articles.index',
                    'active' => 'admin.articles.*',
                    'icon' => 'fa-solid fa-newspaper',
                    'roles' => ['admin', 'editor'],
                ],
                [
                    'label' => 'Custom Page',
                    'route' => 'admin.pages.index',
                    'active' => 'admin.pages.*',
                    'icon' => 'fa-solid fa-file-lines',
                    'roles' => ['admin', 'editor'],
                ],
                [
                    'label' => 'Partner Bisnis',
                    'route' => 'admin.partners.index',
                    'active' => 'admin.partners.*',
                    'icon' => 'fa-solid fa-handshake',
                    'roles' => ['admin', 'editor'],
                ],
                [
                    'label' => 'FAQ',
                    'route' => 'admin.faqs.index',
                    'active' => 'admin.faqs.*',
                    'icon' => 'fa-solid fa-circle-question',
                    'roles' => ['admin', 'editor'],
                ],
                [
                    'label' => 'Media Library',
                    'route' => 'admin.media-assets.index',
                    'active' => 'admin.media-assets.*',
                    'icon' => 'fa-solid fa-photo-film',
                    'roles' => ['admin', 'editor'],
                ],
            ],
        ],

        [
            'label' => 'Pengaturan',
            'items' => [
                [
                    'label' => 'Pengaturan Website',
                    'route' => 'admin.site-settings.index',
                    'active' => 'admin.site-settings.*',
                    'icon' => 'fa-solid fa-gear',
                    'roles' => ['admin'],
                ],
                [
                    'label' => 'SEO',
                    'route' => 'admin.seo-settings.edit',
                    'active' => 'admin.seo-settings.*',
                    'icon' => 'fa-solid fa-magnifying-glass-chart',
                    'roles' => ['admin'],
                ],
                [
                    'label' => 'Template WhatsApp',
                    'route' => 'admin.whatsapp-templates.index',
                    'active' => 'admin.whatsapp-templates.*',
                    'icon' => 'fa-brands fa-whatsapp',
                    'roles' => ['admin'],
                ],
                [
                    'label' => 'User Management',
                    'route' => 'admin.users.index',
                    'active' => 'admin.users.*',
                    'icon' => 'fa-solid fa-users-gear',
                    'roles' => ['admin'],
                ],
                [
                    'label' => 'Backup Data',
                    'route' => 'admin.backups.index',
                    'active' => 'admin.backups.*',
                    'icon' => 'fa-solid fa-file-export',
                    'roles' => ['admin'],
                ],
                [
                    'label' => 'Activity Log',
                    'route' => 'admin.activity-logs.index',
                    'active' => 'admin.activity-logs.*',
                    'icon' => 'fa-solid fa-clock-rotate-left',
                    'roles' => ['admin'],
                ],
            ],
        ],

        [
            'label' => 'Akun',
            'items' => [
                [
                    'label' => 'Profil',
                    'route' => 'admin.profile.edit',
                    'active' => 'admin.profile.*',
                    'icon' => 'fa-solid fa-user',
                    'roles' => ['admin', 'editor', 'staff'],
                ],
            ],
        ],
    ];
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

<body data-admin-layout data-success-message="{{ session('success') }}" data-error-message="{{ session('error') }}"
    data-validation-errors="@if ($errors->any()) <ul class='text-left'>@foreach ($errors->all() as $error)<li>{{ e($error) }}</li>@endforeach</ul> @endif"
    class="min-h-screen bg-[#f8f2e8] text-stone-900 antialiased">
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
                        B
                    </div>

                    <div>
                        <h1 class="text-lg font-black tracking-tight text-stone-950">{{ $siteName }}</h1>
                        <p class="text-xs font-medium uppercase tracking-[0.25em] text-amber-700">CMS Batik</p>
                    </div>
                </div>
            </div>

            <div class="h-[calc(100vh-6rem)] overflow-y-auto px-5 py-6">
                <nav class="space-y-1">
                    @foreach ($navSections as $sectionIndex => $section)
                        @php
                            $visibleItems = collect($section['items'])->filter(function ($item) use ($currentUser) {
                                return in_array($currentUser?->role, $item['roles'] ?? [], true) &&
                                    \Illuminate\Support\Facades\Route::has($item['route']);
                            });

                            $isSectionActive = $visibleItems->contains(
                                fn($item) => request()->routeIs($item['active']),
                            );
                            $sectionKey = 'admin-sidebar-section-' . \Illuminate\Support\Str::slug($section['label']);
                        @endphp

                        @if ($visibleItems->isEmpty())
                            @continue
                        @endif

                        <div class="admin-sidebar-section mt-3 first:mt-0" data-sidebar-section="{{ $sectionKey }}"
                            data-default-open="{{ $isSectionActive || $sectionIndex === 0 ? 'true' : 'false' }}">
                            <button type="button" data-sidebar-toggle
                                class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-left text-xs font-black uppercase tracking-[0.2em] text-stone-400 transition hover:bg-white hover:text-stone-700">
                                <span
                                    class="flex h-8 w-8 items-center justify-center rounded-xl bg-stone-100 text-stone-500">
                                    <i class="fa-solid fa-layer-group text-xs"></i>
                                </span>

                                <span class="flex-1 truncate">{{ $section['label'] }}</span>

                                @php
                                    $sectionBadge = $visibleItems->sum(fn($item) => $item['badge'] ?? 0);
                                @endphp

                                @if ($sectionBadge > 0)
                                    <span
                                        class="rounded-full bg-red-100 px-2 py-0.5 text-[10px] font-black text-red-700">
                                        {{ $sectionBadge > 99 ? '99+' : $sectionBadge }}
                                    </span>
                                @endif

                                <i class="fa-solid fa-chevron-down text-[10px] transition duration-200"
                                    data-sidebar-chevron></i>
                            </button>

                            <div data-sidebar-panel class="grid overflow-hidden transition-all duration-300">
                                <div class="space-y-1 py-1 pl-2">
                                    @foreach ($visibleItems as $item)
                                        <a href="{{ route($item['route']) }}"
                                            class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition
                       {{ request()->routeIs($item['active'])
                           ? 'bg-stone-950 text-amber-200 shadow-xl shadow-stone-900/10'
                           : 'text-stone-600 hover:bg-white hover:text-stone-950 hover:shadow-sm' }}">
                                            <span
                                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl text-base
                            {{ request()->routeIs($item['active'])
                                ? 'bg-amber-200 text-stone-950'
                                : 'bg-stone-100 text-stone-500 group-hover:bg-amber-100 group-hover:text-stone-950' }}">
                                                <i class="{{ $item['icon'] }}"></i>
                                            </span>

                                            <span class="flex-1 truncate">{{ $item['label'] }}</span>

                                            @if (($item['badge'] ?? 0) > 0)
                                                <span
                                                    class="rounded-full bg-red-100 px-2 py-0.5 text-[10px] font-black text-red-700">
                                                    {{ $item['badge'] > 99 ? '99+' : $item['badge'] }}
                                                </span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </nav>
            </div>
        </aside>

        <div class="lg:pl-72">
            <header class="sticky top-0 z-20 border-b border-stone-200/80 bg-[#fbf7ef]/90 backdrop-blur-xl">
                <div
                    class="flex min-h-20 flex-col gap-4 px-5 py-5 sm:flex-row sm:items-center sm:justify-between lg:px-8">
                    <div>
                        <p class="mb-1 text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                            Bendo Jaya Admin
                        </p>

                        <h2 class="text-2xl font-black tracking-tight text-stone-950">
                            {{ $title ?? 'Dashboard' }}
                        </h2>

                        <p class="mt-1 text-sm text-stone-500">
                            {{ $subtitle ?? 'Kelola website Bendo Jaya.' }}
                        </p>
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
                    @foreach ($navSections as $sectionIndex => $section)
                        @php
                            $visibleItems = collect($section['items'])->filter(function ($item) use ($currentUser) {
                                return in_array($currentUser?->role, $item['roles'] ?? [], true) &&
                                    \Illuminate\Support\Facades\Route::has($item['route']);
                            });

                            $isSectionActive = $visibleItems->contains(
                                fn($item) => request()->routeIs($item['active']),
                            );
                            $sectionKey =
                                'admin-mobile-sidebar-section-' . \Illuminate\Support\Str::slug($section['label']);
                        @endphp

                        @if ($visibleItems->isEmpty())
                            @continue
                        @endif

                        <div class="admin-sidebar-section mt-3 first:mt-0" data-sidebar-section="{{ $sectionKey }}"
                            data-default-open="{{ $isSectionActive || $sectionIndex === 0 ? 'true' : 'false' }}">
                            <button type="button" data-sidebar-toggle
                                class="flex w-full items-center gap-3 rounded-2xl bg-white px-4 py-3 text-left text-xs font-black uppercase tracking-[0.2em] text-stone-500">
                                <span class="flex-1">{{ $section['label'] }}</span>
                                <i class="fa-solid fa-chevron-down text-[10px] transition duration-200"
                                    data-sidebar-chevron></i>
                            </button>

                            <div data-sidebar-panel class="grid overflow-hidden transition-all duration-300">
                                <div class="grid gap-2 py-2">
                                    @foreach ($visibleItems as $item)
                                        <a href="{{ route($item['route']) }}"
                                            class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold
                       {{ request()->routeIs($item['active']) ? 'bg-stone-950 text-amber-200' : 'bg-white text-stone-600' }}">
                                            <i class="{{ $item['icon'] }} w-5 text-center"></i>

                                            <span class="flex-1">{{ $item['label'] }}</span>

                                            @if (($item['badge'] ?? 0) > 0)
                                                <span
                                                    class="rounded-full bg-red-100 px-2 py-0.5 text-[10px] font-black text-red-700">
                                                    {{ $item['badge'] > 99 ? '99+' : $item['badge'] }}
                                                </span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </header>

            <main class="px-5 py-8 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
