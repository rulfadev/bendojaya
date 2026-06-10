@php
    $eyebrow = method_exists($section, 'translated') ? $section->translated('eyebrow') : $section->eyebrow;

    $title = method_exists($section, 'translated') ? $section->translated('title') : $section->title;

    $subtitle = method_exists($section, 'translated') ? $section->translated('subtitle') : $section->subtitle;

    $content = method_exists($section, 'translated') ? $section->translated('content') : $section->content;
@endphp

<section class="bg-[#FFF8ED] py-20 lg:py-28">
    <div class="mx-auto max-w-4xl px-5 text-center lg:px-8">
        @if ($eyebrow)
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                {{ $eyebrow }}
            </p>
        @endif

        @if ($title)
            <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                {{ $title }}
            </h2>
        @endif

        @if ($subtitle)
            <p class="mx-auto mt-5 max-w-3xl text-base leading-8 text-[#7F756D]">
                {{ $subtitle }}
            </p>
        @endif

        @if ($content)
            <div class="trix-content page-content mt-8 text-left text-base leading-8 text-[#58433D]">
                {!! $content !!}
            </div>
        @endif
    </div>
</section>
