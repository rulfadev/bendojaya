@php
    $items = $section->settings['items'] ?? [];
@endphp

<section class="bg-[#F6EFE4] py-20 lg:py-28">
    <div class="mx-auto max-w-4xl px-5 lg:px-8">
        @if ($section->eyebrow)
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                {{ $section->eyebrow }}
            </p>
        @endif

        @if ($section->title)
            <h2 class="mt-4 font-['Playfair_Display'] text-4xl font-black text-[#3C3B39] sm:text-5xl">
                {{ $section->title }}
            </h2>
        @endif

        <div class="mt-10 divide-y divide-[#D8C5AF] rounded-[2rem] border border-[#D8C5AF] bg-white/70">
            @forelse ($items as $item)
                <details class="group p-6">
                    <summary class="cursor-pointer list-none font-black text-[#3C3B39]">
                        {{ $item['question'] ?? 'Pertanyaan' }}
                    </summary>
                    <p class="mt-4 text-sm leading-7 text-[#7F756D]">
                        {{ $item['answer'] ?? '' }}
                    </p>
                </details>
            @empty
                <div class="p-6 text-sm text-[#7F756D]">
                    Belum ada FAQ.
                </div>
            @endforelse
        </div>
    </div>
</section>
