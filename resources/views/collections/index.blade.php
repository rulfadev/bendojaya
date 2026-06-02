@extends('layouts.frontend')

@section('content')
    <section class="bg-[#3C3B39] py-24 text-[#FBE9CB]">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">Koleksi</p>
            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight">
                Koleksi Batik Bendo Jaya.
            </h1>
            <p class="mt-6 max-w-2xl text-sm leading-7 text-[#E6D8C8]">
                Pilihan koleksi batik dengan karakter hangat, feminin, dan elegan.
            </p>
        </div>
    </section>

    <section class="py-24">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($collections as $collection)
                    <article class="group">
                        <a href="{{ route('collections.show', $collection) }}" class="block">
                            <div class="overflow-hidden rounded-[2.5rem] bg-[#F6EFE4] p-3">
                                <img src="{{ $collection->main_image ? asset('storage/' . $collection->main_image) : asset('assets/frontend/hero-product.jpg') }}"
                                    alt="{{ $collection->name }}"
                                    class="h-[520px] w-full rounded-[2rem] object-cover transition duration-700 group-hover:scale-105">
                            </div>

                            <div class="pt-6">
                                <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                                    {{ $collection->category ?: 'Bendo Jaya Collection' }}
                                </p>

                                <h2 class="mt-3 font-['Playfair_Display'] text-3xl font-black text-[#3C3B39]">
                                    {{ $collection->name }}
                                </h2>

                                <p class="mt-3 text-sm leading-7 text-[#7F756D]">
                                    {{ $collection->short_description }}
                                </p>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $collections->links() }}
            </div>
        </div>
    </section>
@endsection
