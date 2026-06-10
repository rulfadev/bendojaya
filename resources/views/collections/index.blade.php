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

        $collectionShowUrl = function ($collection) use ($isEnglish, $localizeUrl) {
            if ($isEnglish && \Illuminate\Support\Facades\Route::has('en.collections.show')) {
                return route('en.collections.show', $collection);
            }

            return $localizeUrl(route('collections.show', $collection));
        };
    @endphp

    <section class="bg-[#3C3B39] py-24 text-[#FBE9CB]">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                {{ __('frontend.collections') }}
            </p>

            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight">
                {{ __('frontend.collections_page_title') }}
            </h1>

            <p class="mt-6 max-w-2xl text-sm leading-7 text-[#E6D8C8]">
                {{ __('frontend.collections_page_description') }}
            </p>
        </div>
    </section>

    <section class="py-24">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($collections as $collection)
                    @php
                        $name = $getText($collection, 'name', 'Bendo Jaya Collection');
                        $category = $getText($collection, 'category', 'Bendo Jaya Collection');
                        $shortDescription = $getText(
                            $collection,
                            'short_description',
                            __('frontend.collection_default_description'),
                        );
                    @endphp

                    <article class="group">
                        <a href="{{ $collectionShowUrl($collection) }}" class="block">
                            <div class="overflow-hidden rounded-[2.5rem] bg-[#F6EFE4] p-3">
                                <img src="{{ $collection->main_image ? asset('storage/' . $collection->main_image) : asset('assets/frontend/hero-product.jpg') }}"
                                    alt="{{ $name }}"
                                    class="h-[520px] w-full rounded-[2rem] object-cover transition duration-700 group-hover:scale-105">
                            </div>

                            <div class="pt-6">
                                <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                                    {{ $category ?: 'Bendo Jaya Collection' }}
                                </p>

                                <h2 class="mt-3 font-['Playfair_Display'] text-3xl font-black text-[#3C3B39]">
                                    {{ $name }}
                                </h2>

                                <p class="mt-3 text-sm leading-7 text-[#7F756D]">
                                    {{ $shortDescription }}
                                </p>
                            </div>
                        </a>
                    </article>
                @empty
                    <div
                        class="rounded-[2rem] border border-[#E6D8C8] bg-white p-10 text-center text-[#7F756D] md:col-span-2 lg:col-span-3">
                        {{ __('frontend.no_collections') }}
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $collections->links() }}
            </div>
        </div>
    </section>
@endsection
