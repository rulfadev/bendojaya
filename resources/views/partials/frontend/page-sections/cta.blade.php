@php
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

<section class="bg-[#FFF8ED] py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="rounded-[2.5rem] bg-[#3C3B39] p-8 text-center text-[#FBE9CB] sm:p-12 lg:p-16">
            @if ($eyebrow)
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                    {{ $eyebrow }}
                </p>
            @endif

            @if ($title)
                <h2
                    class="mx-auto mt-5 max-w-4xl font-['Playfair_Display'] text-4xl font-black leading-tight sm:text-5xl">
                    {{ $title }}
                </h2>
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
    </div>
</section>
