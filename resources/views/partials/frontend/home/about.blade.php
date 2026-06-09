@php
    $aboutImage = $homepage?->about_image
        ? asset('storage/' . $homepage->about_image)
        : asset('assets/frontend/hero-product.jpg');

    $isEnglish = app()->getLocale() === 'en';

    $aboutUrl = $homepage?->about_button_url ?: '/pages/tentang-bendo-jaya';

    if ($isEnglish && str_starts_with($aboutUrl, '/') && !str_starts_with($aboutUrl, '/en')) {
        $aboutUrl = '/en' . $aboutUrl;
    }

    $aboutHref = str_starts_with($aboutUrl, '/') ? url($aboutUrl) : $aboutUrl;

    $translatedAboutPoints = null;

    if ($homepage && $isEnglish && method_exists($homepage, 'contentTranslations')) {
        $translatedAboutPoints = data_get(
            $homepage
                ->contentTranslations()
                ->where('locale', app()->getLocale())
                ->first()?->data,
            'about_points',
        );
    }

    $aboutPoints = collect($translatedAboutPoints ?: __('frontend.about_points'));
@endphp

<section id="about" class="bg-[#FFF8ED] py-24 lg:py-32">
    <div class="mx-auto grid max-w-7xl items-center gap-14 px-5 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
        <div class="relative">
            <div class="overflow-hidden rounded-[3rem] bg-[#F6EFE4] p-3 shadow-xl shadow-[#3C3B39]/10">
                <img src="{{ $aboutImage }}" alt="{{ $homepage?->about_title ?: __('frontend.about_image_alt') }}"
                    class="h-[480px] w-full rounded-[2.35rem] object-cover sm:h-[620px]">
            </div>

            <div
                class="absolute -bottom-8 left-5 right-5 rounded-[2rem] border border-[#E6D8C8] bg-white/90 p-6 shadow-xl backdrop-blur sm:left-auto sm:right-8 sm:w-72">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                    {{ __('frontend.about_card_brand') }}</p>
                <p class="mt-3 font-['Playfair_Display'] text-3xl font-black leading-tight text-[#3C3B39]">
                    {{ __('frontend.about_card_title') }}
                </p>
            </div>
        </div>

        <div class="pt-10 lg:pt-0">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                {{ $homepage?->about_eyebrow ?: __('frontend.about_eyebrow') }}
            </p>

            <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                {{ $homepage?->about_title ?: __('frontend.about_title') }}
            </h2>

            <p class="mt-6 text-base leading-8 text-[#7F756D]">
                {{ $homepage?->about_description ?: __('frontend.about_description') }}
            </p>

            <div class="mt-9 space-y-5">
                @foreach ($aboutPoints as $index => $point)
                    <div class="flex gap-5">
                        <span
                            class="mt-1 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#3C3B39] text-sm font-black text-[#FBE9CB]">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <div>
                            <h3 class="font-black text-[#3C3B39]">{{ data_get($point, 'title') }}</h3>
                            <p class="mt-1 text-sm leading-7 text-[#7F756D]">{{ data_get($point, 'description') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($homepage?->show_about_button)
                <a href="{{ $aboutHref }}"
                    class="mt-10 inline-flex rounded-full border border-[#765A4F] px-7 py-4 text-sm font-black text-[#765A4F] transition hover:-translate-y-1 hover:bg-[#765A4F] hover:text-white">
                    {{ $homepage?->about_button_label ?: __('frontend.about_button_label') }}
                </a>
            @endif
        </div>
    </div>
</section>
