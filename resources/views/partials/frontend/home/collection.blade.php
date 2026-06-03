@php
    $collectionItems = collect($collections ?? []);
    $defaultImage = asset('assets/frontend/hero-product.jpg');
@endphp

<section id="collection" class="bg-[#FFF8ED] py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="mb-14 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-3xl">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                    {{ $homepage?->collections_eyebrow ?: 'Koleksi Pilihan' }}
                </p>

                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    {{ $homepage?->collections_title ?: 'Koleksi batik dengan warna hangat dan motif berkarakter.' }}
                </h2>

                @if ($homepage?->collections_description)
                    <p class="mt-5 text-base leading-8 text-[#7F756D]">
                        {{ $homepage->collections_description }}
                    </p>
                @endif
            </div>

            <a href="{{ route('collections.index') }}"
                class="group inline-flex w-fit items-center gap-4 rounded-full border border-[#765A4F]/40 bg-[#FFF8ED] px-6 py-4 text-sm font-black text-[#58433D] shadow-sm transition hover:-translate-y-1 hover:border-[#3C3B39] hover:bg-[#3C3B39] hover:text-[#FBE9CB] sm:px-7">
                <span>Lihat Semua Koleksi</span>
                <span
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-[#3C3B39] text-[#FBE9CB] transition group-hover:bg-[#FBE9CB] group-hover:text-[#3C3B39]">
                    →
                </span>
            </a>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">
            @forelse ($collectionItems as $collection)
                @php
                    $name = data_get($collection, 'name', 'Bendo Jaya Collection');
                    $category = data_get($collection, 'category', 'Bendo Jaya Collection');
                    $shortDescription = data_get(
                        $collection,
                        'short_description',
                        'Koleksi batik Bendo Jaya dengan karakter hangat dan elegan.',
                    );
                    $mainImage = data_get($collection, 'main_image');
                    $slug = data_get($collection, 'slug');

                    $detailUrl = $slug ? route('collections.show', $slug) : route('collections.index');

                    $image = $mainImage ? asset('storage/' . $mainImage) : $defaultImage;

                    $objectPosition = match ($loop->iteration) {
                        1 => 'object-left',
                        2 => 'object-center',
                        default => 'object-right',
                    };
                @endphp

                <article class="group">
                    <a href="{{ $detailUrl }}" class="block">
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
                    </a>
                </article>
            @empty
                <div class="rounded-[2rem] border border-[#E6D8C8] bg-white p-10 text-[#7F756D] lg:col-span-3">
                    Belum ada koleksi aktif.
                </div>
            @endforelse
        </div>
    </div>
</section>
