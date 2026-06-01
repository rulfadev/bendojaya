@php
    $logo = $setting?->logo ? asset('storage/' . $setting->logo) : asset('assets/frontend/logo-bendo-jaya.jpg');
@endphp

<header class="sticky top-0 z-50 border-b border-white/10 bg-[#3C3B39]/95 backdrop-blur-xl">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-5 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ $logo }}" alt="Bendo Jaya" class="h-12 w-auto object-contain">
        </a>

        <nav class="hidden items-center gap-8 text-sm font-bold text-[#FBE9CB]/85 lg:flex">
            <a href="{{ route('home') }}/#home" class="transition hover:text-[#EEBDB5]">Beranda</a>
            <a href="{{ route('home') }}/#about" class="transition hover:text-[#EEBDB5]">Tentang</a>
            <a href="{{ route('home') }}/#services" class="transition hover:text-[#EEBDB5]">Layanan</a>
            <a href="{{ route('home') }}/#collection" class="transition hover:text-[#EEBDB5]">Koleksi</a>
            <a href="{{ route('home') }}/#gallery" class="transition hover:text-[#EEBDB5]">Gallery</a>
            <a href="{{ route('home') }}/#articles" class="transition hover:text-[#EEBDB5]">Artikel</a>
        </nav>

        <div class="flex items-center gap-3">
            <x-frontend.consultation-link class="hidden sm:inline-flex !bg-[#FBE9CB] !text-[#3C3B39] hover:!bg-white" />

            <button type="button"
                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-[#FBE9CB]/20 bg-white/5 text-[#FBE9CB] lg:hidden">
                <span class="text-xl">☰</span>
            </button>
        </div>
    </div>
</header>
