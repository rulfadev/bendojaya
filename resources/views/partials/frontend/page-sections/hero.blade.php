@php
    $image = $section->image ? asset('storage/' . $section->image) : asset('assets/frontend/hero-product.jpg');

    $eyebrow = method_exists($section, 'translated') ? $section->translated('eyebrow') : $section->eyebrow;

    $title = method_exists($section, 'translated') ? $section->translated('title') : $section->title;

    $subtitle = method_exists($section, 'translated') ? $section->translated('subtitle') : $section->subtitle;

    $buttonLabel = method_exists($section, 'translated')
        ? $section->translated('button_label')
        : $section->button_label;

    $buttonUrl = $section->button_url ?: '#';

    if (app()->getLocale() === 'en' && str_starts_with($buttonUrl, '/') && !str_starts_with($buttonUrl, '/en')) {
        $buttonUrl = '/en' . $buttonUrl;
    }

    $buttonHref = str_starts_with($buttonUrl, '/') ? url($buttonUrl) : $buttonUrl;
@endphp

<section class="relative overflow-hidden bg-[#3C3B39] py-28 text-[#FBE9CB] lg:py-36">
    <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('{{ $image }}');">
    </div>
    <div class="absolute inset-0 bg-[#3C3B39]/75"></div>

    <div class="relative mx-auto max-w-5xl px-5 text-center lg:px-8">
        @if ($eyebrow)
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                {{ $eyebrow }}
            </p>
        @endif

        @if ($title)
            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight sm:text-6xl">
                {{ $title }}
            </h1>
        @endif

        @if ($subtitle)
            <p class="mx-auto mt-6 max-w-3xl text-base leading-8 text-[#E6D8C8]">
                {{ $subtitle }}
            </p>
        @endif

        @if ($buttonLabel)
            <a href="{{ $buttonHref }}"
                class="mt-8 inline-flex rounded-full bg-[#FBE9CB] px-8 py-4 text-sm font-black text-[#3C3B39] transition hover:-translate-y-1 hover:bg-white">
                {{ $buttonLabel }}
            </a>
        @endif
    </div>
</section>
