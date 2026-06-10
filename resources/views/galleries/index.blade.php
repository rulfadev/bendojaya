@extends('layouts.frontend')

@section('content')
    @php
        $isEnglish = app()->getLocale() === 'en';

        $getText = function ($item, string $field, mixed $fallback = null) {
            if (is_object($item) && method_exists($item, 'translated')) {
                return $item->translated($field, null, data_get($item, $field, $fallback));
            }

            return data_get($item, $field, $fallback);
        };

        $galleryShowUrl = function ($gallery) use ($isEnglish) {
            if ($isEnglish && \Illuminate\Support\Facades\Route::has('en.galleries.show')) {
                return route('en.galleries.show', $gallery);
            }

            return route('galleries.show', $gallery);
        };
    @endphp

    <section class="bg-[#3C3B39] py-24 text-[#FBE9CB]">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                {{ __('frontend.gallery') }}
            </p>

            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight">
                {{ __('frontend.gallery_page_title') }}
            </h1>

            <p class="mt-6 max-w-2xl text-sm leading-7 text-[#E6D8C8]">
                {{ __('frontend.gallery_page_description') }}
            </p>
        </div>
    </section>

    <section class="py-24">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($galleries as $gallery)
                    @php
                        $category = $getText($gallery, 'category', 'Gallery');
                        $title = $getText($gallery, 'title', 'Bendo Jaya Gallery');
                        $caption = $getText($gallery, 'caption');
                    @endphp

                    <a href="{{ $galleryShowUrl($gallery) }}"
                        class="group overflow-hidden rounded-[2rem] border border-[#E6D8C8] bg-white shadow-sm">
                        <div class="overflow-hidden">
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $title }}"
                                class="h-96 w-full object-cover transition duration-700 group-hover:scale-105">
                        </div>

                        <div class="p-6">
                            <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                                {{ $category ?: 'Gallery' }}
                            </p>

                            <h2 class="mt-3 font-['Playfair_Display'] text-2xl font-black text-[#3C3B39]">
                                {{ $title }}
                            </h2>

                            @if ($caption)
                                <p class="mt-3 text-sm leading-7 text-[#7F756D]">
                                    {{ $caption }}
                                </p>
                            @endif
                        </div>
                    </a>
                @empty
                    <div
                        class="rounded-[2rem] border border-[#E6D8C8] bg-white p-10 text-center text-[#7F756D] sm:col-span-2 lg:col-span-3">
                        {{ __('frontend.no_gallery') }}
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $galleries->links() }}
            </div>
        </div>
    </section>
@endsection
