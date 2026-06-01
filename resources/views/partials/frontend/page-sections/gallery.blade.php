@php
    $image = $section->image ? asset('storage/' . $section->image) : asset('assets/frontend/hero-product.jpg');
@endphp

<section class="bg-[#3C3B39] py-20 text-[#FBE9CB] lg:py-28">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="mb-10 max-w-3xl">
            @if ($section->eyebrow)
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                    {{ $section->eyebrow }}
                </p>
            @endif

            @if ($section->title)
                <h2 class="mt-4 font-['Playfair_Display'] text-4xl font-black sm:text-5xl">
                    {{ $section->title }}
                </h2>
            @endif

            @if ($section->subtitle)
                <p class="mt-5 text-sm leading-7 text-[#E6D8C8]">
                    {{ $section->subtitle }}
                </p>
            @endif
        </div>

        <div class="grid gap-5 md:grid-cols-3">
            <img src="{{ $image }}" class="h-96 w-full rounded-[2rem] object-cover object-left" alt="">
            <img src="{{ $image }}" class="h-96 w-full rounded-[2rem] object-cover object-center md:mt-12"
                alt="">
            <img src="{{ $image }}" class="h-96 w-full rounded-[2rem] object-cover object-right" alt="">
        </div>
    </div>
</section>
