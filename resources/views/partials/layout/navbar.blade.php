@php
    $logo = $setting?->logo ? asset('storage/' . $setting->logo) : asset('assets/frontend/logo-bendo-jaya.png');

    $headerMenus = \App\Models\NavigationMenu::query()->active()->forHeader()->orderBy('sort_order')->get();

    $isEnglish = request()->is('en') || request()->is('en/*');

    $homeUrl = $isEnglish ? url('/en') : route('home');

    $localizedHref = function (?string $href) use ($isEnglish, $homeUrl) {
        $href = trim((string) $href);

        if ($href === '') {
            return $homeUrl;
        }

        if (
            str_starts_with($href, 'http://') ||
            str_starts_with($href, 'https://') ||
            str_starts_with($href, 'mailto:') ||
            str_starts_with($href, 'tel:')
        ) {
            return $href;
        }

        if (str_starts_with($href, '#')) {
            return $homeUrl . $href;
        }

        if ($isEnglish) {
            if (str_starts_with($href, '/en')) {
                return url($href);
            }

            if (str_starts_with($href, '/')) {
                return url('/en' . $href);
            }

            return url('/en/' . ltrim($href, '/'));
        }

        $href = preg_replace('#^/en(/|$)#', '/', $href);

        return str_starts_with($href, '/') ? url($href) : url('/' . ltrim($href, '/'));
    };
@endphp

<header class="sticky top-0 z-50 border-b border-white/10 bg-[#3C3B39]/95 backdrop-blur-xl">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-5 lg:px-8">
        <a href="{{ $homeUrl }}" class="flex items-center">
            <img src="{{ $logo }}" alt="{{ $setting?->site_name ?? 'Bendo Jaya' }}"
                class="h-12 w-auto object-contain">
        </a>

        <nav class="hidden items-center gap-8 text-sm font-bold text-[#FBE9CB]/85 lg:flex">
            @forelse ($headerMenus as $menu)
                <a href="{{ $localizedHref($menu->href) }}" target="{{ $menu->target }}"
                    class="transition hover:text-[#EEBDB5]">
                    {{ $menu->label }}
                </a>
            @empty
                <a href="{{ $homeUrl }}" class="transition hover:text-[#EEBDB5]">
                    {{ __('frontend.home') }}
                </a>

                <a href="{{ $homeUrl }}#about" class="transition hover:text-[#EEBDB5]">
                    {{ __('frontend.about') }}
                </a>

                <a href="{{ $homeUrl }}#services" class="transition hover:text-[#EEBDB5]">
                    {{ __('frontend.services') }}
                </a>

                <a href="{{ $homeUrl }}#collection" class="transition hover:text-[#EEBDB5]">
                    {{ __('frontend.collections') }}
                </a>

                <a href="{{ $isEnglish ? url('/en/articles') : route('articles.index') }}"
                    class="transition hover:text-[#EEBDB5]">
                    {{ __('frontend.articles') }}
                </a>
            @endforelse
        </nav>

        <div class="flex items-center gap-3">
            <x-frontend.language-switcher />

            <x-frontend.consultation-link class="hidden sm:inline-flex !bg-[#FBE9CB] !text-[#3C3B39] hover:!bg-white">
                {{ __('frontend.consult_now') }}
            </x-frontend.consultation-link>

            <button type="button"
                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-[#FBE9CB]/20 bg-white/5 text-[#FBE9CB] lg:hidden"
                data-mobile-menu-toggle aria-label="{{ __('frontend.menu') }}">
                <span class="text-xl">☰</span>
            </button>
        </div>
    </div>

    <div class="hidden border-t border-white/10 bg-[#3C3B39]/95 px-5 pb-5 lg:hidden" data-mobile-menu>
        <nav class="grid gap-3 pt-4 text-sm font-bold text-[#FBE9CB]/85">
            @forelse ($headerMenus as $menu)
                <a href="{{ $localizedHref($menu->href) }}" target="{{ $menu->target }}"
                    class="rounded-2xl border border-[#FBE9CB]/10 bg-white/5 px-4 py-3 transition hover:text-[#EEBDB5]">
                    {{ $menu->label }}
                </a>
            @empty
                <a href="{{ $homeUrl }}"
                    class="rounded-2xl border border-[#FBE9CB]/10 bg-white/5 px-4 py-3 transition hover:text-[#EEBDB5]">
                    {{ __('frontend.home') }}
                </a>

                <a href="{{ $homeUrl }}#about"
                    class="rounded-2xl border border-[#FBE9CB]/10 bg-white/5 px-4 py-3 transition hover:text-[#EEBDB5]">
                    {{ __('frontend.about') }}
                </a>

                <a href="{{ $homeUrl }}#services"
                    class="rounded-2xl border border-[#FBE9CB]/10 bg-white/5 px-4 py-3 transition hover:text-[#EEBDB5]">
                    {{ __('frontend.services') }}
                </a>

                <a href="{{ $homeUrl }}#collection"
                    class="rounded-2xl border border-[#FBE9CB]/10 bg-white/5 px-4 py-3 transition hover:text-[#EEBDB5]">
                    {{ __('frontend.collections') }}
                </a>

                <a href="{{ $isEnglish ? url('/en/articles') : route('articles.index') }}"
                    class="rounded-2xl border border-[#FBE9CB]/10 bg-white/5 px-4 py-3 transition hover:text-[#EEBDB5]">
                    {{ __('frontend.articles') }}
                </a>
            @endforelse

            <x-frontend.consultation-link class="mt-2 justify-center !bg-[#FBE9CB] !text-[#3C3B39] hover:!bg-white">
                {{ __('frontend.consult_now') }}
            </x-frontend.consultation-link>
        </nav>
    </div>
</header>
