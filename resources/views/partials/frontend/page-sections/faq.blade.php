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

        <div class="mt-10 divide-y divide-[#D8C5AF] flex flex-col gap-2">
            @foreach ($items as $faq)
                <x-frontend.faq-item :question="$faq['question'] ?? 'Pertanyaan'" :answer="$faq['answer'] ?? ''" />
            @endforeach
        </div>
    </div>
</section>
