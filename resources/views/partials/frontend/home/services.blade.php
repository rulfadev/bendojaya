@php
    $serviceItems = collect($services ?? []);
    $defaultServiceImage = asset('assets/frontend/hero-product.jpg');
@endphp

<section id="services" class="bg-[#F6EFE4] py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="mb-14 grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-end">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                    {{ $homepage?->services_eyebrow ?: 'Layanan' }}
                </p>

                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    {{ $homepage?->services_title ?: 'Layanan batik untuk kebutuhan personal, komunitas, dan bisnis.' }}
                </h2>
            </div>

            <p class="text-base leading-8 text-[#7F756D]">
                {{ $homepage?->services_description ?: 'Mulai dari koleksi siap pakai, custom pakaian, hingga kerja sama produksi.' }}
            </p>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            @forelse ($serviceItems as $service)
                @php
                    $getText = function ($item, string $field, mixed $fallback = null) {
                        if (is_object($item) && method_exists($item, 'translated')) {
                            return $item->translated($field, null, data_get($item, $field, $fallback));
                        }

                        return data_get($item, $field, $fallback);
                    };

                    $title = $getText($service, 'title', $getText($service, 'name', 'Layanan Bendo Jaya'));

                    $shortDescription = $getText(
                        $service,
                        'short_description',
                        $getText($service, 'description', 'Layanan batik dan custom fashion.'),
                    );

                    $image = data_get($service, 'image')
                        ? asset('storage/' . data_get($service, 'image'))
                        : $defaultServiceImage;

                    $showButton = data_get($service, 'show_button', true);

                    $buttonLabel =
                        $getText($service, 'button_text', data_get($service, 'button_label')) ?: __('frontend.consult');

                    $customButtonUrl = data_get($service, 'button_url');
                    $settingButtonUrl = $setting?->consultation_url;

                    if ($customButtonUrl) {
                        $buttonHref = str_starts_with($customButtonUrl, '/') ? url($customButtonUrl) : $customButtonUrl;
                    } elseif ($settingButtonUrl) {
                        $buttonHref = str_starts_with($settingButtonUrl, '/')
                            ? url($settingButtonUrl)
                            : $settingButtonUrl;
                    } else {
                        $buttonHref = \App\Support\WhatsappMessage::url('service', [
                            'service_title' => $title,
                        ]);
                    }
                @endphp

                <article
                    class="group rounded-[2.25rem] border border-[#E6D8C8] bg-white p-3 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#3C3B39]/10">
                    <div class="relative overflow-hidden rounded-[1.75rem]">
                        <img src="{{ $image }}" alt="{{ $title }}"
                            class="h-52 w-full object-cover transition duration-700 group-hover:scale-105 sm:h-56">

                        <div
                            class="absolute left-4 top-4 flex h-11 w-11 items-center justify-center rounded-full bg-[#FBE9CB] text-sm font-black text-[#3C3B39] shadow-lg">
                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>

                    <div class="p-5">
                        <div class="mb-4 flex items-center gap-3">
                            <span
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-[#3C3B39] text-[#FBE9CB]">
                                <i class="fa-solid fa-shirt text-sm"></i>
                            </span>

                            <span class="h-px flex-1 bg-[#E6D8C8]"></span>
                        </div>

                        <h3 class="font-['Playfair_Display'] text-2xl font-black leading-tight text-[#3C3B39]">
                            {{ $title }}
                        </h3>

                        <p class="mt-4 text-sm leading-7 text-[#7F756D]">
                            {{ $shortDescription }}
                        </p>

                        @if ($showButton)
                            <a href="{{ $buttonHref }}"
                                class="mt-7 inline-flex items-center gap-3 rounded-full border border-[#765A4F]/35 px-5 py-3 text-sm font-black text-[#765A4F] transition hover:bg-[#765A4F] hover:text-white">
                                {{ $buttonLabel }}
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </a>
                        @endif
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-[#E6D8C8] bg-white p-8 text-[#7F756D] lg:col-span-3">
                    {{ __('frontend.no_active_services') }}
                </div>
            @endforelse
        </div>
    </div>
</section>
