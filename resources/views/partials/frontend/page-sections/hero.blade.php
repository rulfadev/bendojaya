@php
    $image = $section->image ? asset('storage/' . $section->image) : asset('assets/frontend/hero-product.jpg');

    $buttonUrl = $section->button_url ?: '#';
@endphp

<section class="relative overflow-hidden bg-[#3C3B39] py-28 text-[#FBE9CB] lg:py-36">
    <div class="absolute inset-0 bg-cover bg-center opacity-40" style="background-image: url('{{ $image }}');">
    </div>

    <div class="absolute inset-0 bg-gradient-to-r from-[#3C3B39] via-[#3C3B39]/80 to-[#3C3B39]/35"></div>

    <div class="relative mx-auto max-w-7xl px-5 lg:px-8">
        <div class="max-w-3xl">
            @if ($section->eyebrow)
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                    {{ $section->eyebrow }}
                </p>
            @endif

            @if ($section->title)
                <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight sm:text-6xl">
                    {{ $section->title }}
                </h1>
            @endif

            @if ($section->subtitle)
                <p class="mt-6 max-w-2xl text-base leading-8 text-[#E6D8C8]">
                    {{ $section->subtitle }}
                </p>
            @endif

            @if ($section->button_label)
                <a href="{{ $buttonUrl }}"
                    class="mt-9 inline-flex rounded-full bg-[#FBE9CB] px-8 py-4 text-sm font-black text-[#3C3B39] transition hover:bg-white">
                    {{ $section->button_label }}
                </a>
            @endif
        </div>
    </div>
</section>
