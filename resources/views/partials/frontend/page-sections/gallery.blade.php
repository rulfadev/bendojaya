@php
    $eyebrow = method_exists($section, 'translated') ? $section->translated('eyebrow') : $section->eyebrow;

    $title = method_exists($section, 'translated') ? $section->translated('title') : $section->title;

    $subtitle = method_exists($section, 'translated') ? $section->translated('subtitle') : $section->subtitle;

    $settings = method_exists($section, 'translated')
        ? $section->translated('settings', null, $section->settings ?? [])
        : $section->settings ?? [];

    if (is_string($settings)) {
        $decodedSettings = json_decode($settings, true);
        $settings = json_last_error() === JSON_ERROR_NONE ? $decodedSettings : [];
    }

    $items = $settings['items'] ?? [];
@endphp

<section class="bg-[#FFF8ED] py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="mb-12 max-w-3xl">
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
        </div>

        @if (!empty($items))
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($items as $item)
                    @php
                        $image = data_get($item, 'image')
                            ? asset('storage/' . data_get($item, 'image'))
                            : asset('assets/frontend/hero-product.jpg');

                        $itemTitle = data_get($item, 'title');
                        $itemCaption = data_get($item, 'caption');
                    @endphp

                    <article class="overflow-hidden rounded-[2rem] border border-[#E6D8C8] bg-white shadow-sm">
                        <img src="{{ $image }}" alt="{{ $itemTitle ?: 'Bendo Jaya Gallery' }}"
                            class="h-80 w-full object-cover">

                        @if ($itemTitle || $itemCaption)
                            <div class="p-6">
                                @if ($itemTitle)
                                    <h3 class="font-['Playfair_Display'] text-2xl font-black text-[#3C3B39]">
                                        {{ $itemTitle }}
                                    </h3>
                                @endif

                                @if ($itemCaption)
                                    <p class="mt-3 text-sm leading-7 text-[#7F756D]">
                                        {{ $itemCaption }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
