@extends('layouts.frontend')

@section('content')
    @php
        $isEnglish = app()->getLocale() === 'en';

        $localizeUrl = function (?string $url): string {
            $url = trim((string) $url);

            if ($url === '') {
                return '#';
            }

            if (str_starts_with($url, 'mailto:') || str_starts_with($url, 'tel:')) {
                return $url;
            }

            $baseUrl = rtrim(url('/'), '/');

            if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
                if (!str_starts_with($url, $baseUrl)) {
                    return $url;
                }

                $url = '/' . ltrim(str_replace($baseUrl, '', $url), '/');
            }

            if (str_starts_with($url, '#')) {
                return app()->getLocale() === 'en' ? url('/en') . $url : url('/') . $url;
            }

            if (app()->getLocale() === 'en') {
                if ($url === '/en' || str_starts_with($url, '/en/')) {
                    return url($url);
                }

                if (str_starts_with($url, 'en/')) {
                    return url('/' . $url);
                }

                return url('/en/' . ltrim($url, '/'));
            }

            $url = preg_replace('#^/?en(/|$)#', '/', $url);

            return url('/' . ltrim($url, '/'));
        };

        $getText = function ($item, string $field, mixed $fallback = null) {
            if (is_object($item) && method_exists($item, 'translated')) {
                return $item->translated($field, null, data_get($item, $field, $fallback));
            }

            return data_get($item, $field, $fallback);
        };

        $collectionsIndexUrl =
            $isEnglish && \Illuminate\Support\Facades\Route::has('en.collections.index')
                ? route('en.collections.index')
                : $localizeUrl(route('collections.index'));

        $collectionShowUrl = function ($item) use ($isEnglish, $localizeUrl) {
            if ($isEnglish && \Illuminate\Support\Facades\Route::has('en.collections.show')) {
                return route('en.collections.show', $item);
            }

            return $localizeUrl(route('collections.show', $item));
        };

        $name = $getText($collection, 'name', 'Bendo Jaya Collection');
        $category = $getText($collection, 'category', 'Bendo Jaya Collection');
        $shortDescription = $getText($collection, 'short_description');
        $description = $getText($collection, 'description');
        $material = $getText($collection, 'material');
        $colorPalette = $getText($collection, 'color_palette');
        $sizeInfo = $getText($collection, 'size_info');

        $image = $collection->main_image
            ? asset('storage/' . $collection->main_image)
            : asset('assets/frontend/hero-product.jpg');
    @endphp

    <section class="py-20 lg:py-28">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 lg:grid-cols-2 lg:px-8">
            <div class="overflow-hidden rounded-[2.5rem] bg-[#F6EFE4] p-3">
                <img src="{{ $image }}" alt="{{ $name }}" class="h-[640px] w-full rounded-[2rem] object-cover">
            </div>

            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                    {{ $category ?: 'Bendo Jaya Collection' }}
                </p>

                <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight text-[#3C3B39]">
                    {{ $name }}
                </h1>

                @if ($shortDescription)
                    <p class="mt-6 text-base leading-8 text-[#7F756D]">
                        {{ $shortDescription }}
                    </p>
                @endif

                <div class="mt-8 space-y-4 rounded-[2rem] border border-[#E6D8C8] bg-white p-6">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-[#8A3F35]">
                            {{ __('frontend.collection_material') }}
                        </p>
                        <p class="mt-1 font-semibold text-[#3C3B39]">{{ $material ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-[#8A3F35]">
                            {{ __('frontend.collection_color') }}
                        </p>
                        <p class="mt-1 font-semibold text-[#3C3B39]">{{ $colorPalette ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-[#8A3F35]">
                            {{ __('frontend.collection_size') }}
                        </p>
                        <p class="mt-1 font-semibold text-[#3C3B39]">{{ $sizeInfo ?: '-' }}</p>
                    </div>
                </div>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <x-frontend.consultation-link :label="__('frontend.ask_this_collection')" template="collection" :data="[
                        'collection_name' => $name,
                        'collection_category' => $category,
                    ]" />

                    <a href="{{ $collectionsIndexUrl }}"
                        class="inline-flex justify-center rounded-full border border-[#765A4F] px-7 py-4 text-sm font-black text-[#765A4F]">
                        {{ __('frontend.back_to_collections') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-24">
        <div class="mx-auto max-w-4xl px-5 lg:px-8">
            <article class="rounded-[2rem] border border-[#E6D8C8] bg-white p-8 text-[#58433D]">
                <h2 class="font-['Playfair_Display'] text-3xl font-black text-[#3C3B39]">
                    {{ __('frontend.collection_description_title') }}
                </h2>

                <div class="trix-content mt-6 space-y-5 text-base leading-8">
                    {!! $description ?: '<p>' . e(__('frontend.collection_description_empty')) . '</p>' !!}
                </div>
            </article>
        </div>
    </section>

    <section class="bg-[#FFF8ED] py-20">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 lg:grid-cols-[0.85fr_1.15fr] lg:px-8">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                    {{ __('frontend.collection_inquiry_eyebrow') }}
                </p>

                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39]">
                    {{ __('frontend.collection_inquiry_title') }}
                </h2>

                <p class="mt-5 text-base leading-8 text-[#7F756D]">
                    {{ __('frontend.collection_inquiry_description') }}
                </p>

                <div class="mt-8">
                    <x-frontend.consultation-link :label="__('frontend.consult_whatsapp')" template="collection" :data="[
                        'collection_name' => $name,
                        'collection_category' => $category,
                    ]" />
                </div>
            </div>

            <div class="rounded-[2rem] border border-[#E6D8C8] bg-white p-6 shadow-sm">
                @include('partials.frontend.collection-inquiry-form')
            </div>
        </div>
    </section>

    @if ($relatedCollections->isNotEmpty())
        <section class="bg-[#F6EFE4] py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <h2 class="font-['Playfair_Display'] text-4xl font-black text-[#3C3B39]">
                    {{ __('frontend.related_collections') }}
                </h2>

                <div class="mt-10 grid gap-8 md:grid-cols-3">
                    @foreach ($relatedCollections as $item)
                        @php
                            $relatedName = $getText($item, 'name', 'Bendo Jaya Collection');
                        @endphp

                        <a href="{{ $collectionShowUrl($item) }}" class="group">
                            <img src="{{ $item->main_image ? asset('storage/' . $item->main_image) : asset('assets/frontend/hero-product.jpg') }}"
                                alt="{{ $relatedName }}"
                                class="h-96 w-full rounded-[2rem] object-cover transition group-hover:scale-[1.02]">

                            <h3 class="mt-5 font-['Playfair_Display'] text-2xl font-black text-[#3C3B39]">
                                {{ $relatedName }}
                            </h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
