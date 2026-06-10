@php
    $settings = method_exists($section, 'translated')
        ? $section->translated('settings', null, $section->settings ?? [])
        : $section->settings ?? [];

    if (is_string($settings)) {
        $decodedSettings = json_decode($settings, true);
        $settings = json_last_error() === JSON_ERROR_NONE ? $decodedSettings : [];
    }

    $items = $settings['items'] ?? [];

    $eyebrow = method_exists($section, 'translated') ? $section->translated('eyebrow') : $section->eyebrow;

    $title = method_exists($section, 'translated') ? $section->translated('title') : $section->title;

    $subtitle = method_exists($section, 'translated') ? $section->translated('subtitle') : $section->subtitle;
@endphp

<section class="bg-[#FFF8ED] py-20 lg:py-28">
    <div class="mx-auto max-w-5xl px-5 lg:px-8">
        <div class="mb-12 text-center">
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
        </div>

        @if (!empty($items))
            <div class="space-y-4">
                @foreach ($items as $faq)
                    <x-frontend.faq-item :question="data_get($faq, 'question')" :answer="data_get($faq, 'answer')" />
                @endforeach
            </div>
        @endif
    </div>
</section>
