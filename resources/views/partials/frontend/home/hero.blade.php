@php
    use App\Support\LocalizedRoute;
    use App\Support\WhatsappMessage;

    $heroImage = $homepage?->hero_image
        ? asset('storage/' . $homepage->hero_image)
        : asset('assets/frontend/hero-product.jpg');

    $primaryUrl = $homepage?->hero_primary_url;
    $secondaryUrl = $homepage?->hero_secondary_url;

    if ($primaryUrl) {
        $primaryHref = LocalizedRoute::url($primaryUrl);
    } else {
        $primaryHref = WhatsappMessage::url('hero', [
            'page_title' => $homepage?->hero_title ?? 'Bendo Jaya',
            'current_url' => LocalizedRoute::route('home'),
        ]);
    }

    if ($secondaryUrl) {
        $secondaryHref = LocalizedRoute::url($secondaryUrl);
    } else {
        $secondaryHref = LocalizedRoute::route('collections.index');
    }
@endphp

<section id="home" class="relative min-h-[calc(100vh-80px)] overflow-hidden bg-[#3C3B39] text-[#FBE9CB]">
    <div class="absolute inset-0 bg-cover bg-center opacity-45" style="background-image: url('{{ $heroImage }}');">
    </div>

    <div class="absolute inset-0 bg-gradient-to-r from-[#3C3B39] via-[#3C3B39]/82 to-[#3C3B39]/35"></div>

    <div class="absolute inset-0 opacity-[0.12]"
        style="background-image: radial-gradient(circle at 1px 1px, #FBE9CB 1px, transparent 0); background-size: 28px 28px;">
    </div>

    <div class="relative mx-auto flex min-h-[calc(100vh-80px)] max-w-7xl items-center px-5 py-20 lg:px-8">
        <div class="max-w-3xl">
            <p
                class="inline-flex rounded-full border border-[#FBE9CB]/25 bg-[#FBE9CB]/10 px-5 py-2 text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5] backdrop-blur">
                {{ $homepage?->hero_eyebrow ?: 'Bendo Jaya Batik Fashion' }}
            </p>

            <h1
                class="mt-7 font-['Playfair_Display'] text-5xl font-black leading-[1.05] tracking-tight sm:text-6xl lg:text-7xl">
                {{ $homepage?->hero_title ?: 'Batik Tradisional dengan Sentuhan Elegan Modern.' }}
            </h1>

            <p class="mt-7 max-w-2xl text-base leading-8 text-[#E6D8C8] sm:text-lg">
                {{ $homepage?->hero_subtitle ?: 'Koleksi pakaian batik, custom seragam, dan kerja sama produksi untuk brand, komunitas, maupun instansi.' }}
            </p>

            <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                @if ($homepage?->hero_primary_label)
                    <a href="{{ $primaryHref }}"
                        target="{{ str_starts_with($primaryHref, 'http') ? '_blank' : '_self' }}"
                        rel="{{ str_starts_with($primaryHref, 'http') ? 'noopener' : '' }}"
                        class="inline-flex items-center justify-center gap-3 rounded-full bg-[#FBE9CB] px-8 py-4 text-sm font-black text-[#3C3B39] transition hover:-translate-y-1 hover:bg-white">
                        @if (str_contains($primaryHref, 'wa.me'))
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                        @endif

                        {{ $homepage->hero_primary_label }}
                    </a>
                @endif

                @if ($homepage?->hero_secondary_label)
                    <a href="{{ $secondaryHref }}"
                        class="inline-flex items-center justify-center gap-3 rounded-full border border-[#FBE9CB]/35 bg-white/5 px-8 py-4 text-sm font-black text-[#FBE9CB] backdrop-blur transition hover:-translate-y-1 hover:bg-white/10">
                        {{ $homepage->hero_secondary_label }}
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
