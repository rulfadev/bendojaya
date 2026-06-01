<section class="py-20 lg:py-28">
    <div class="mx-auto max-w-4xl px-5 lg:px-8">
        @if ($section->eyebrow)
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                {{ $section->eyebrow }}
            </p>
        @endif

        @if ($section->title)
            <h2 class="mt-4 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                {{ $section->title }}
            </h2>
        @endif

        @if ($section->subtitle)
            <p class="mt-5 text-base leading-8 text-[#7F756D]">
                {{ $section->subtitle }}
            </p>
        @endif

        @if ($section->content)
            <div class="mt-8 space-y-5 text-base leading-8 text-[#58433D]">
                {!! $section->content !!}
            </div>
        @endif
    </div>
</section>
