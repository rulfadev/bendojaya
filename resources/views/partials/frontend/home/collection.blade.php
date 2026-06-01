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

            <x-frontend.consultation-link label="Tanya Koleksi" variant="outline-brown" />
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
                    <div class="overflow-hidden rounded-[2.5rem] bg-[#F6EFE4] p-3">
                        <img src="{{ $image }}" alt="{{ $name }}"
                            class="h-[520px] w-full rounded-[2rem] object-cover transition duration-700 group-hover:scale-105 {{ $objectPosition }}">
                    </div>

                    <div class="pt-6">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                            {{ $category ?: 'Bendo Jaya Collection' }}
                        </p>

                        <h3 class="mt-3 font-['Playfair_Display'] text-3xl font-black text-[#3C3B39]">
                            {{ $name }}
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-[#7F756D]">
                            {{ $shortDescription }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
