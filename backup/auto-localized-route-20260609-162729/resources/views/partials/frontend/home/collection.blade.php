@php
    $collectionItems = collect($collections ?? []);
    $defaultImage = asset('assets/frontend/hero-product.jpg');
    $isEnglish = app()->getLocale() === 'en';

    $getText = function ($item, string $field, mixed $fallback = null) {
        if (is_object($item) && method_exists($item, 'translated')) {
            return $item->translated($field, null, data_get($item, $field, $fallback));
        }

        return data_get($item, $field, $fallback);
    };

    $collectionsIndexUrl =
        $isEnglish && \Illuminate\Support\Facades\Route::has('en.collections.index')
            ? route('en.collections.index')
            : route('collections.index');

    $collectionShowUrl = function ($collection, $slug) use ($isEnglish) {
        if ($isEnglish && \Illuminate\Support\Facades\Route::has('en.collections.show')) {
            return route('en.collections.show', $slug ?: $collection);
        }

        return $slug ? route('collections.show', $slug) : route('collections.index');
    };
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

            <a href="{{ $collectionsIndexUrl }}"
                class="group inline-flex w-fit items-center gap-4 rounded-full bg-[#3C3B39] px-6 py-4 text-sm font-black text-[#FBE9CB] shadow-xl shadow-[#3C3B39]/10 transition hover:-translate-y-1 hover:bg-[#58433D] sm:px-7">
                <span>{{ __('frontend.view_all_collections') }}</span>
                <span
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-[#FBE9CB] text-[#3C3B39] transition group-hover:translate-x-1">
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </span>
            </a>
        </div>

        <div class="grid gap-8 lg:grid-cols-12">
            @forelse ($collectionItems as $collection)
                @php
                    $name = $getText($collection, 'name', 'Bendo Jaya Collection');
                    $category = $getText($collection, 'category', 'Bendo Jaya Collection');

                    $shortDescription = $getText($collection, 'short_description', __('frontend.footer_description'));

                    $mainImage = data_get($collection, 'main_image');
                    $slug = data_get($collection, 'slug');
                    $detailUrl = $collectionShowUrl($collection, $slug);

                    $image = $mainImage ? asset('storage/' . $mainImage) : $defaultImage;

                    $spanClass = $loop->first ? 'lg:col-span-6' : 'lg:col-span-3';
                    $heightClass = $loop->first ? 'h-[620px]' : 'h-[520px]';
                    $titleClass = $loop->first ? 'text-4xl' : 'text-3xl';
                @endphp

                <article class="{{ $spanClass }} group my-auto">
                    <a href="{{ $detailUrl }}" class="block h-auto">
                        <div
                            class="relative h-full overflow-hidden rounded-[2.5rem] bg-[#F6EFE4] p-3 shadow-sm transition duration-300 group-hover:-translate-y-1 group-hover:shadow-xl group-hover:shadow-[#3C3B39]/10">
                            <img src="{{ $image }}" alt="{{ $name }}"
                                class="{{ $heightClass }} w-full rounded-[2rem] object-cover transition duration-700 group-hover:scale-105">

                            <div
                                class="absolute inset-3 flex rounded-[2rem] bg-gradient-to-t from-[#2F2D2B]/95 via-[#2F2D2B]/50 to-transparent p-6 text-[#FBE9CB]">
                                <div class="mt-auto">
                                    <p class="text-xs font-black uppercase tracking-[0.25em] text-[#EEBDB5]">
                                        {{ $category ?: 'Bendo Jaya Collection' }}
                                    </p>

                                    <h3
                                        class="mt-1 font-['Playfair_Display'] {{ $titleClass }} font-black leading-tight">
                                        {{ $name }}
                                    </h3>

                                    <p class="mt-1 line-clamp-3 text-sm leading-4 text-[#E6D8C8]">
                                        {{ $shortDescription }}
                                    </p>

                                    <div
                                        class="mt-3 inline-flex items-center gap-3 rounded-full bg-[#FBE9CB] px-5 py-3 text-sm font-black text-[#3C3B39] transition group-hover:bg-white">
                                        {{ __('frontend.collection_detail') }}
                                        <i
                                            class="fa-solid fa-arrow-right text-xs transition group-hover:translate-x-1"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
            @empty
                <div class="rounded-[2rem] border border-[#E6D8C8] bg-white p-10 text-[#7F756D] lg:col-span-12">
                    {{ __('frontend.no_active_collections') }}
                </div>
            @endforelse
        </div>
    </div>
</section>
