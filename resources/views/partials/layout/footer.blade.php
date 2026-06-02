@php
    $logo = $setting?->logo ? asset('storage/' . $setting->logo) : asset('assets/frontend/logo-bendo-jaya.jpg');
    $whatsapp = $setting?->whatsapp_number ?? '6280000000000';
    $footerMenus = \App\Models\NavigationMenu::query()->active()->forFooter()->orderBy('sort_order')->get();
@endphp

<footer class="bg-[#3C3B39] text-[#FBE9CB]">
    <div class="mx-auto max-w-7xl px-5 py-16 lg:px-8">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
            <div>
                <img src="{{ $logo }}" alt="Bendo Jaya" class="mb-5 h-14 w-auto rounded-xl object-contain">
                <p class="max-w-sm text-sm leading-7 text-[#E6D8C8]">
                    {{ $setting?->short_description ?? 'Bendo Jaya Batik Fashion menghadirkan koleksi batik elegan, hangat, dan modern untuk kebutuhan harian, custom, maupun kerja sama brand.' }}
                </p>
            </div>

            <div>
                <h3 class="mb-5 text-sm font-black uppercase tracking-[0.25em] text-[#EEBDB5]">Menu</h3>
                <div class="space-y-3 text-sm text-[#E6D8C8]">
                    @forelse ($footerMenus as $menu)
                        <a href="{{ $menu->href }}" target="{{ $menu->target }}" class="block hover:text-white">
                            {{ $menu->label }}
                        </a>
                    @empty
                        <a href="{{ route('home') }}" class="block hover:text-white">Beranda</a>
                        <a href="{{ route('articles.index') }}" class="block hover:text-white">Artikel</a>
                        <a href="{{ route('home') }}#contact" class="block hover:text-white">Kontak</a>
                    @endforelse
                </div>
            </div>

            <div>
                <h3 class="mb-5 text-sm font-black uppercase tracking-[0.25em] text-[#EEBDB5]">Layanan</h3>
                <div class="space-y-3 text-sm text-[#E6D8C8]">
                    <p>Koleksi Batik Wanita</p>
                    <p>Custom Dress Batik</p>
                    <p>Seragam dan Komunitas</p>
                    <p>Kerja Sama Brand</p>
                </div>
            </div>

            <div>
                <h3 class="mb-5 text-sm font-black uppercase tracking-[0.25em] text-[#EEBDB5]">Kontak</h3>
                <div class="space-y-3 text-sm text-[#E6D8C8]">
                    <p>{{ $setting?->email ?? 'info@bendojaya.id' }}</p>
                    <p>{{ $setting?->address ?? 'Indonesia' }}</p>
                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                        class="inline-flex rounded-full bg-[#FBE9CB] px-5 py-3 font-bold text-[#3C3B39] transition hover:bg-white">
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-12 border-t border-white/10 pt-6 text-sm text-[#E6D8C8]">
            © {{ date('Y') }} Bendo Jaya Batik Fashion. All rights reserved.
        </div>
    </div>
</footer>
