@php
    $fallbackServices = collect([
        (object) [
            'title' => 'Koleksi Batik Wanita Ready to Wear',
            'short_description' => 'Pilihan dress dan pakaian batik wanita dengan motif elegan untuk kebutuhan harian.',
            'icon' => '01',
        ],
        (object) [
            'title' => 'Custom Pakaian dan Seragam Batik',
            'short_description' => 'Produksi pakaian batik untuk komunitas, instansi, acara, dan kebutuhan seragam.',
            'icon' => '02',
        ],
        (object) [
            'title' => 'Kerja Sama Brand Fashion dan Komunitas',
            'short_description' =>
                'Terbuka untuk kerja sama produksi, pengembangan koleksi, dan kebutuhan brand partner.',
            'icon' => '03',
        ],
    ]);

    $serviceItems = collect($services ?? []);

    if ($serviceItems->isEmpty()) {
        $serviceItems = $fallbackServices;
    }
@endphp

<section id="services" class="bg-[#F6EFE4] py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:items-end">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">Layanan</p>
                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    Bukan hanya menjual koleksi, kami membangun cerita lewat batik.
                </h2>
            </div>

            <p class="text-base leading-8 text-[#7F756D]">
                Website ini menjadi ruang untuk menampilkan karya, koleksi, gallery, artikel, dan peluang kerja sama.
                E-commerce dapat dikembangkan setelah fondasi brand dan katalog visualnya matang.
            </p>
        </div>

        <div class="mt-14 divide-y divide-[#D8C5AF] border-y border-[#D8C5AF]">
            @foreach ($serviceItems as $service)
                <div class="grid gap-5 py-8 sm:grid-cols-[120px_1fr_auto] sm:items-center">
                    <p class="font-['Playfair_Display'] text-4xl font-black text-[#C99A4A]">
                        {{ $service->icon ?: str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </p>

                    <div>
                        <h3 class="text-2xl font-black text-[#3C3B39]">
                            {{ $service->title }}
                        </h3>

                        <p class="mt-2 max-w-2xl text-sm leading-7 text-[#7F756D]">
                            {{ $service->short_description }}
                        </p>
                    </div>

                    @php
                        $showButton = data_get($service, 'show_button', true);
                        $buttonLabel = data_get($service, 'button_label') ?: 'Konsultasi';
                        $buttonUrl =
                            data_get($service, 'button_url') ?:
                            ($setting?->consultation_url ?:
                            'https://wa.me/' . $whatsapp);

                        $buttonHref = str_starts_with($buttonUrl, '/') ? url($buttonUrl) : $buttonUrl;
                    @endphp

                    @if ($showButton)
                        <a href="{{ $buttonHref }}"
                            class="inline-flex text-sm font-black text-[#8A3F35] transition hover:text-[#3C3B39]">
                            {{ $buttonLabel }} →
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
