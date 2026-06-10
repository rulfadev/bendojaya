@php
    $image = $section->image ? asset('storage/' . $section->image) : asset('assets/frontend/hero-product.jpg');

    $imageFirst = $section->image_position === 'left';

    $eyebrow = method_exists($section, 'translated') ? $section->translated('eyebrow') : $section->eyebrow;

    $title = method_exists($section, 'translated') ? $section->translated('title') : $section->title;

    $subtitle = method_exists($section, 'translated') ? $section->translated('subtitle') : $section->subtitle;

    $content = method_exists($section, 'translated') ? $section->translated('content') : $section->content;

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
    <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 lg:grid-cols-2 lg:px-8">
        <div class="{{ $imageFirst ? 'lg:order-1' : 'lg:order-2' }}">
            <div class="overflow-hidden rounded-[2.5rem] bg-[#F6EFE4] p-3 shadow-sm">
                <img src="{{ $image }}" alt="{{ $title ?: 'Bendo Jaya' }}"
                    class="h-[520px] w-full rounded-[2rem] object-cover">
            </div>
        </div>

        <div class="{{ $imageFirst ? 'lg:order-2' : 'lg:order-1' }}">
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
                <p class="mt-5 text-base leading-8 text-[#7F756D]">
                    {{ $subtitle }}
                </p>
            @endif

            @if ($content)
                <div class="trix-content page-content mt-7 text-base leading-8 text-[#58433D]">
                    {!! $content !!}
                </div>
            @endif

            @if ($buttonLabel)
                <a href="{{ $buttonHref }}"
                    class="mt-8 inline-flex rounded-full border border-[#765A4F] px-7 py-4 text-sm font-black text-[#765A4F] transition hover:-translate-y-1 hover:bg-[#765A4F] hover:text-white">
                    {{ $buttonLabel }}
                </a>
            @endif
        </div>
    </div>
</section>
