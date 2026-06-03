@php
    $serviceItems = collect($services ?? []);
    $defaultServiceImage = asset('assets/frontend/hero-product.jpg');
@endphp

<section id="services" class="bg-[#F6EFE4] py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="mb-14 max-w-3xl">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                {{ $homepage?->services_eyebrow ?: 'Layanan' }}
            </p>

            <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                {{ $homepage?->services_title ?: 'Layanan batik untuk kebutuhan personal, komunitas, dan bisnis.' }}
            </h2>

            @if ($homepage?->services_description)
                <p class="mt-5 text-base leading-8 text-[#7F756D]">
                    {{ $homepage->services_description }}
                </p>
            @endif
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @forelse ($serviceItems as $service)
                @php
                    $title = data_get($service, 'title', 'Layanan Bendo Jaya');
                    $shortDescription = data_get($service, 'short_description', 'Layanan batik dan custom fashion.');
                    $image = data_get($service, 'image')
                        ? asset('storage/' . data_get($service, 'image'))
                        : $defaultServiceImage;
                    $showButton = data_get($service, 'show_button', true);
                    $buttonLabel = data_get($service, 'button_label') ?: 'Konsultasi';
                    $buttonUrl =
                        data_get($service, 'button_url') ?:
                        ($setting?->consultation_url ?:
                        'https://wa.me/' . ($setting?->whatsapp_number ?? '6280000000000'));
                    $buttonHref = str_starts_with($buttonUrl, '/') ? url($buttonUrl) : $buttonUrl;
                @endphp

                <article
                    class="group overflow-hidden rounded-[2rem] border border-[#E6D8C8] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ $image }}" alt="{{ $title }}"
                            class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                    </div>

                    <div class="p-7">
                        <h3 class="font-['Playfair_Display'] text-2xl font-black text-[#3C3B39]">
                            {{ $title }}
                        </h3>

                        <p class="mt-4 text-sm leading-7 text-[#7F756D]">
                            {{ $shortDescription }}
                        </p>

                        @if ($showButton)
                            <a href="{{ $buttonHref }}"
                                class="mt-6 inline-flex text-sm font-black text-[#8A3F35] transition hover:text-[#3C3B39]">
                                {{ $buttonLabel }} →
                            </a>
                        @endif
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-[#E6D8C8] bg-white p-8 text-[#7F756D] md:col-span-3">
                    Belum ada layanan aktif.
                </div>
            @endforelse
        </div>
    </div>
</section>
