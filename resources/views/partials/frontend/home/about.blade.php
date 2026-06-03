@php
    $aboutImage = $homepage?->about_image
        ? asset('storage/' . $homepage->about_image)
        : asset('assets/frontend/hero-product.jpg');

    $aboutUrl = $homepage?->about_button_url ?: '/pages/tentang-bendo-jaya';
    $aboutHref = str_starts_with($aboutUrl, '/') ? url($aboutUrl) : $aboutUrl;
@endphp

<section id="about" class="bg-[#FFF8ED] py-24 lg:py-32">
    <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 lg:grid-cols-2 lg:px-8">
        <div class="order-2 lg:order-1">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                {{ $homepage?->about_eyebrow ?: 'Tentang Bendo Jaya' }}
            </p>

            <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                {{ $homepage?->about_title ?: 'Menghadirkan batik sebagai identitas gaya yang hangat dan elegan.' }}
            </h2>

            <p class="mt-6 text-base leading-8 text-[#7F756D]">
                {{ $homepage?->about_description ?: 'Bendo Jaya mengembangkan pakaian batik dengan karakter tradisional, warna hangat, dan tampilan yang cocok untuk kebutuhan harian, acara, hingga custom produksi.' }}
            </p>

            <div class="mt-8 grid gap-4 sm:grid-cols-3">
                <div class="rounded-3xl border border-[#E6D8C8] bg-white/70 p-5">
                    <p class="font-['Playfair_Display'] text-3xl font-black text-[#3C3B39]">Custom</p>
                    <p class="mt-2 text-xs font-bold uppercase tracking-[0.18em] text-[#8A3F35]">Produksi</p>
                </div>

                <div class="rounded-3xl border border-[#E6D8C8] bg-white/70 p-5">
                    <p class="font-['Playfair_Display'] text-3xl font-black text-[#3C3B39]">Batik</p>
                    <p class="mt-2 text-xs font-bold uppercase tracking-[0.18em] text-[#8A3F35]">Fashion</p>
                </div>

                <div class="rounded-3xl border border-[#E6D8C8] bg-white/70 p-5">
                    <p class="font-['Playfair_Display'] text-3xl font-black text-[#3C3B39]">Brand</p>
                    <p class="mt-2 text-xs font-bold uppercase tracking-[0.18em] text-[#8A3F35]">Partner</p>
                </div>
            </div>

            @if ($homepage?->show_about_button)
                <a href="{{ $aboutHref }}"
                    class="mt-9 inline-flex rounded-full border border-[#765A4F] px-7 py-4 text-sm font-black text-[#765A4F] transition hover:-translate-y-1 hover:bg-[#765A4F] hover:text-white">
                    {{ $homepage?->about_button_label ?: 'Selengkapnya Tentang Kami' }}
                </a>
            @endif
        </div>

        <div class="order-1 lg:order-2">
            <div
                class="overflow-hidden rounded-[2.5rem] border border-[#E6D8C8] bg-white p-3 shadow-xl shadow-[#3C3B39]/10">
                <img src="{{ $aboutImage }}" alt="{{ $homepage?->about_title ?: 'Tentang Bendo Jaya' }}"
                    class="h-[520px] w-full rounded-[2rem] object-cover object-center">
            </div>
        </div>
    </div>
</section>
