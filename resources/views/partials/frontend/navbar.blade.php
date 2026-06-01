@php
    $logo = $setting?->logo ? asset('storage/' . $setting->logo) : asset('assets/frontend/logo-bendo-jaya.jpg');

    $whatsapp = $setting?->whatsapp_number ?? '6280000000000';
@endphp

<header class="sticky top-0 z-50 border-b border-[#E6D8C8]/80 bg-[#FFF8ED]/90 backdrop-blur-xl">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-5 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ $logo }}" alt="Bendo Jaya" class="h-12 w-auto rounded-xl object-contain">
        </a>

        <nav class="hidden items-center gap-8 text-sm font-semibold text-[#58433D] lg:flex">
            <a href="#home" class="transition hover:text-[#8A3F35]">Beranda</a>
            <a href="#about" class="transition hover:text-[#8A3F35]">Tentang</a>
            <a href="#services" class="transition hover:text-[#8A3F35]">Layanan</a>
            <a href="#collection" class="transition hover:text-[#8A3F35]">Koleksi</a>
            <a href="#gallery" class="transition hover:text-[#8A3F35]">Gallery</a>
            <a href="#articles" class="transition hover:text-[#8A3F35]">Artikel</a>
        </nav>

        <div class="flex items-center gap-3">
            <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                class="hidden rounded-full bg-[#3C3B39] px-5 py-3 text-sm font-bold text-[#FBE9CB] shadow-lg shadow-[#3C3B39]/10 transition hover:-translate-y-0.5 hover:bg-[#58433D] sm:inline-flex">
                Konsultasi
            </a>

            <button type="button"
                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-[#E6D8C8] bg-white text-[#3C3B39] lg:hidden">
                <span class="text-xl">☰</span>
            </button>
        </div>
    </div>
</header>
