@extends('layouts.frontend')

@section('content')
    @php
        $image = $collection->main_image
            ? asset('storage/' . $collection->main_image)
            : asset('assets/frontend/hero-product.jpg');
    @endphp

    <section class="py-20 lg:py-28">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 lg:grid-cols-2 lg:px-8">
            <div class="overflow-hidden rounded-[2.5rem] bg-[#F6EFE4] p-3">
                <img src="{{ $image }}" alt="{{ $collection->name }}"
                    class="h-[640px] w-full rounded-[2rem] object-cover">
            </div>

            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                    {{ $collection->category ?: 'Bendo Jaya Collection' }}
                </p>

                <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight text-[#3C3B39]">
                    {{ $collection->name }}
                </h1>

                <p class="mt-6 text-base leading-8 text-[#7F756D]">
                    {{ $collection->short_description }}
                </p>

                <div class="mt-8 space-y-4 rounded-[2rem] border border-[#E6D8C8] bg-white p-6">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-[#8A3F35]">Bahan</p>
                        <p class="mt-1 font-semibold text-[#3C3B39]">{{ $collection->material ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-[#8A3F35]">Warna</p>
                        <p class="mt-1 font-semibold text-[#3C3B39]">{{ $collection->color_palette ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-[#8A3F35]">Ukuran</p>
                        <p class="mt-1 font-semibold text-[#3C3B39]">{{ $collection->size_info ?: '-' }}</p>
                    </div>
                </div>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <x-frontend.consultation-link label="Tanya Koleksi Ini" template="collection" :data="[
                        'collection_name' => $collection->name,
                        'collection_category' => $collection->category,
                    ]" />
                    <a href="{{ route('collections.index') }}"
                        class="inline-flex justify-center rounded-full border border-[#765A4F] px-7 py-4 text-sm font-black text-[#765A4F]">
                        Kembali ke Koleksi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-24">
        <div class="mx-auto max-w-4xl px-5 lg:px-8">
            <article class="rounded-[2rem] border border-[#E6D8C8] bg-white p-8 text-[#58433D]">
                <h2 class="font-['Playfair_Display'] text-3xl font-black text-[#3C3B39]">
                    Deskripsi Koleksi
                </h2>

                <div class="mt-6 space-y-5 text-base leading-8">
                    {!! $collection->description ?: '<p>Deskripsi koleksi belum tersedia.</p>' !!}
                </div>
            </article>
        </div>
    </section>

    @if ($relatedCollections->isNotEmpty())
        <section class="bg-[#F6EFE4] py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <h2 class="font-['Playfair_Display'] text-4xl font-black text-[#3C3B39]">
                    Koleksi Lainnya
                </h2>

                <div class="mt-10 grid gap-8 md:grid-cols-3">
                    @foreach ($relatedCollections as $item)
                        <a href="{{ route('collections.show', $item) }}" class="group">
                            <img src="{{ $item->main_image ? asset('storage/' . $item->main_image) : asset('assets/frontend/hero-product.jpg') }}"
                                alt="{{ $item->name }}"
                                class="h-96 w-full rounded-[2rem] object-cover transition group-hover:scale-[1.02]">

                            <h3 class="mt-5 font-['Playfair_Display'] text-2xl font-black text-[#3C3B39]">
                                {{ $item->name }}
                            </h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
