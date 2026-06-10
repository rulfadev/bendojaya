@php
    $partnerItems = collect($partners ?? [])->filter();

    $loopItems = collect();

    if ($partnerItems->isNotEmpty()) {
        for ($i = 0; $i < 12; $i++) {
            $loopItems = $loopItems->merge($partnerItems);
        }
    }

    $partnersImage = $homepage?->partners_image
        ? asset('storage/' . $homepage->partners_image)
        : asset('assets/frontend/hero-product.jpg');

    $isEnglish = app()->getLocale() === 'en';

    $partnershipUrl = $isEnglish ? url('/en/pages/kerja-sama') : url('/pages/kerja-sama');
@endphp
@if ($partnerItems->isNotEmpty())
    <div class="partner-marquee-wrap overflow-hidden border-y border-[#E6D8C8] py-7 bg-[#FFF8ED]">
        <div class="partner-marquee-track gap-12 pr-12">
            @foreach ($loopItems as $partner)
                <a href="{{ $partner->website_url ?: 'javascript:void(0)' }}"
                    target="{{ $partner->website_url ? '_blank' : '_self' }}"
                    class="group flex h-20 min-w-44 shrink-0 items-center justify-center px-4">
                    @if ($partner->logo)
                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                            class="max-h-12 max-w-40 object-contain grayscale opacity-70 transition duration-500 group-hover:grayscale-0 group-hover:opacity-100">
                    @else
                        <span
                            class="whitespace-nowrap text-center text-base font-black uppercase tracking-[0.18em] text-[#3C3B39]/55 transition group-hover:text-[#8A3F35]">
                            {{ $partner->name }}
                        </span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
@endif
<section id="partners" class="bg-[#FFF8ED] py-24">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div
            class="grid overflow-hidden rounded-[2.5rem] border border-[#E6D8C8] bg-[#F6EFE4] lg:grid-cols-[1.1fr_0.9fr]">
            <div class="p-8 sm:p-12 lg:p-16">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                    {{ $homepage?->partners_eyebrow ?: 'Kerja Sama' }}
                </p>

                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    {{ $homepage?->partners_title ?: 'Terbuka untuk brand, komunitas, dan kebutuhan custom.' }}
                </h2>

                <p class="mt-6 max-w-2xl text-base leading-8 text-[#7F756D]">
                    {{ $homepage?->partners_description ?: 'Bendo Jaya dapat menjadi partner untuk kebutuhan koleksi fashion, custom pakaian batik, seragam komunitas, maupun pengembangan produk bersama brand.' }}
                </p>

                <div class="mt-8 grid gap-4 text-sm leading-7 text-[#58433D] sm:grid-cols-3">
                    @php
                        $translatedPartnersPoints = null;

                        if ($homepage && $isEnglish && method_exists($homepage, 'contentTranslations')) {
                            $translatedPartnersPoints = data_get(
                                $homepage
                                    ->contentTranslations()
                                    ->where('locale', app()->getLocale())
                                    ->first()?->data,
                                'partners_points',
                            );
                        }

                        $partnersPoints = collect($translatedPartnersPoints ?: __('frontend.partners_points'));
                    @endphp
                    @foreach ($partnersPoints as $point)
                        <div>
                            <h3 class="font-black text-[#3C3B39]">{{ data_get($point, 'title') }}</h3>
                            <p class="mt-1 text-sm leading-7 text-[#7F756D]">{{ data_get($point, 'description') }}</p>
                        </div>
                    @endforeach
                </div>

                <a href="{{ url('#contact') }}"
                    class="mt-10 inline-flex items-center gap-3 rounded-full bg-[#3C3B39] px-6 py-4 text-sm font-black text-[#FBE9CB] transition hover:-translate-y-1 hover:bg-[#58433D]">
                    <i class="fa-brands fa-whatsapp text-lg"></i> {{ __('frontend.submit_partnership') }}
                </a>
            </div>

            <div class="relative min-h-[420px] lg:min-h-full">
                <img src="{{ $partnersImage }}" alt="{{ $homepage?->partners_title ?: 'Kerja sama Bendo Jaya' }}"
                    class="absolute inset-0 h-full w-full object-cover object-right">
            </div>
        </div>
    </div>
</section>
