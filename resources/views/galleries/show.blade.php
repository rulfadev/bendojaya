@extends('layouts.frontend')

@section('content')
    <section class="py-20 lg:py-28">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-[1.15fr_0.85fr] lg:items-start">
                <div class="overflow-hidden rounded-[2.5rem] bg-[#F6EFE4] p-3">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                        class="max-h-[760px] w-full rounded-[2rem] object-cover">
                </div>

                <div class="lg:sticky lg:top-28">
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                        {{ $gallery->category ?: 'Gallery' }}
                    </p>

                    <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight text-[#3C3B39]">
                        {{ $gallery->title }}
                    </h1>

                    @if ($gallery->caption)
                        <p class="mt-6 text-base leading-8 text-[#7F756D]">
                            {{ $gallery->caption }}
                        </p>
                    @endif

                    @if ($gallery->description)
                        <article
                            class="mt-8 rounded-[2rem] border border-[#E6D8C8] bg-white p-6 text-sm leading-7 text-[#58433D]">
                            {!! nl2br(e($gallery->description)) !!}
                        </article>
                    @endif

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('galleries.index') }}"
                            class="inline-flex justify-center rounded-full border border-[#765A4F] px-7 py-4 text-sm font-black text-[#765A4F] transition hover:bg-[#765A4F] hover:text-white">
                            Kembali ke Gallery
                        </a>

                        <x-frontend.consultation-link label="Konsultasi" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($relatedGalleries->isNotEmpty())
        <section class="bg-[#F6EFE4] py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <h2 class="font-['Playfair_Display'] text-4xl font-black text-[#3C3B39]">
                    Gallery Lainnya
                </h2>

                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedGalleries as $item)
                        <a href="{{ route('galleries.show', $item) }}" class="group">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                class="h-80 w-full rounded-[2rem] object-cover transition duration-500 group-hover:scale-[1.02]">

                            <h3 class="mt-5 font-['Playfair_Display'] text-2xl font-black text-[#3C3B39]">
                                {{ $item->title }}
                            </h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
