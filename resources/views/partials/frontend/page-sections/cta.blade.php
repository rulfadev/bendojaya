<section class="py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div
            class="relative overflow-hidden rounded-[2.5rem] bg-[#3C3B39] px-8 py-20 text-center text-[#FBE9CB] lg:px-16">
            <div class="absolute inset-0 opacity-[0.1]"
                style="background-image: radial-gradient(circle at 1px 1px, #FBE9CB 1px, transparent 0); background-size: 28px 28px;">
            </div>

            <div class="relative mx-auto max-w-3xl">
                @if ($section->eyebrow)
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                        {{ $section->eyebrow }}
                    </p>
                @endif

                @if ($section->title)
                    <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight sm:text-5xl">
                        {{ $section->title }}
                    </h2>
                @endif

                @if ($section->subtitle)
                    <p class="mx-auto mt-6 max-w-2xl text-sm leading-7 text-[#E6D8C8]">
                        {{ $section->subtitle }}
                    </p>
                @endif

                @if ($section->button_label)
                    <a href="{{ $section->button_url ?: '#' }}"
                        class="mt-9 inline-flex rounded-full bg-[#FBE9CB] px-8 py-4 text-sm font-black text-[#3C3B39] transition hover:bg-white">
                        {{ $section->button_label }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
