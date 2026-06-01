@php
    $image = $section->image ? asset('storage/' . $section->image) : asset('assets/frontend/hero-product.jpg');

    $imageFirst = $section->image_position === 'left';
@endphp

<section class="py-20 lg:py-28">
    <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 lg:grid-cols-2 lg:px-8">
        <div class="{{ $imageFirst ? 'lg:order-1' : 'lg:order-2' }}">
            <div
                class="overflow-hidden rounded-[2.5rem] border border-[#E6D8C8] bg-white p-3 shadow-xl shadow-[#3C3B39]/10">
                <img src="{{ $image }}" alt="{{ $section->title }}"
                    class="h-[520px] w-full rounded-[2rem] object-cover">
            </div>
        </div>

        <div class="{{ $imageFirst ? 'lg:order-2' : 'lg:order-1' }}">
            @if ($section->eyebrow)
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                    {{ $section->eyebrow }}
                </p>
            @endif

            @if ($section->title)
                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    {{ $section->title }}
                </h2>
            @endif

            @if ($section->subtitle)
                <p class="mt-6 text-base leading-8 text-[#7F756D]">
                    {{ $section->subtitle }}
                </p>
            @endif

            @if ($section->content)
                <div class="mt-8 space-y-5 text-base leading-8 text-[#58433D]">
                    {!! $section->content !!}
                </div>
            @endif

            @if ($section->button_label)
                <a href="{{ $section->button_url ?: '#' }}"
                    class="mt-9 inline-flex rounded-full bg-[#3C3B39] px-8 py-4 text-sm font-black text-[#FBE9CB] transition hover:bg-[#58433D]">
                    {{ $section->button_label }}
                </a>
            @endif
        </div>
    </div>
</section>
