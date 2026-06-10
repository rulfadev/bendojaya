@extends('layouts.frontend')

@section('content')
    @php
        $image = $article->featured_image
            ? asset('storage/' . $article->featured_image)
            : asset('assets/frontend/hero-product.jpg');
    @endphp

    <section class="relative overflow-hidden bg-[#3C3B39] py-28 text-[#FBE9CB]">
        <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('{{ $image }}');">
        </div>
        <div class="absolute inset-0 bg-[#3C3B39]/80"></div>

        <div class="relative mx-auto max-w-5xl px-5 text-center lg:px-8">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                {{ $article->category ?: 'Batik Insight' }}
            </p>

            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight sm:text-6xl">
                {{ $article->title }}
            </h1>

            @if ($article->excerpt)
                <p class="mx-auto mt-6 max-w-3xl text-base leading-8 text-[#E6D8C8]">
                    {{ $article->excerpt }}
                </p>
            @endif
        </div>
    </section>

    <section class="py-20 lg:py-28">
        <div class="mx-auto max-w-4xl px-5 lg:px-8">
            <article class="rounded-[2rem] border border-[#E6D8C8] bg-white/80 p-7 text-[#58433D] shadow-sm sm:p-10">
                <div class="space-y-6 text-base leading-8 trix-content">
                    {!! $article->content ?: '<p>Konten artikel belum tersedia.</p>' !!}
                </div>
            </article>
        </div>
    </section>
@endsection
