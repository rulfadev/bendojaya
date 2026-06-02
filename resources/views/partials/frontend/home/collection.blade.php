@php
    $fallbackCollections = collect([
        [
            'name' => 'Batik Dress Coklat Klasik',
            'category' => 'Signature Collection',
            'short_description' => 'Nuansa coklat hangat dengan motif batik klasik untuk tampilan harian yang anggun.',
            'main_image' => null,
        ],
        [
            'name' => 'Batik Dress Abu Natural',
            'category' => 'Soft Traditional',
            'short_description' => 'Warna natural dengan karakter lembut, cocok untuk gaya santai maupun semi-formal.',
            'main_image' => null,
        ],
        [
            'name' => 'Batik Dress Maroon Elegan',
            'category' => 'Elegant Series',
            'short_description' => 'Pilihan warna maroon yang tegas, feminin, dan tetap membawa sentuhan tradisional.',
            'main_image' => null,
        ],
    ]);

    $collectionItems = collect($collections ?? []);

    if ($collectionItems->isEmpty()) {
        $collectionItems = $fallbackCollections;
    }

    $defaultImage = asset('assets/frontend/hero-product.jpg');
@endphp

<section id="collection" class="py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="mb-14 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                    Koleksi Pilihan
                </p>

                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    Koleksi batik dengan warna hangat dan motif berkarakter.
                </h2>
            </div>

            <a href="{{ route('collections.index') }}"
                class="inline-flex rounded-full border border-[#765A4F] px-7 py-4 text-sm font-black text-[#765A4F] transition hover:bg-[#765A4F] hover:text-white">
                Lihat Semua Koleksi
            </a>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">
            @foreach ($collectionItems as $collection)
                @php
                    $name = data_get($collection, 'name', 'Bendo Jaya Collection');
                    $category = data_get($collection, 'category', 'Bendo Jaya Collection');
                    $shortDescription = data_get(
                        $collection,
                        'short_description',
                        'Koleksi batik Bendo Jaya dengan karakter hangat dan elegan.',
                    );
                    $mainImage = data_get($collection, 'main_image');

                    $image = $mainImage ? asset('storage/' . $mainImage) : $defaultImage;

                    $objectPosition = match ($loop->iteration) {
                        1 => 'object-left',
                        2 => 'object-center',
                        default => 'object-right',
                    };
                @endphp

                <article class="group">
                    @php
                        $detailUrl =
                            is_object($collection) && isset($collection->slug)
                                ? route('collections.show', $collection)
                                : '#';
                    @endphp

                    <a href="{{ $detailUrl }}" class="block">
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>
