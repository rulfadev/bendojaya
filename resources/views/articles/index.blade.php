@extends('layouts.frontend')

@section('content')
    <section class="bg-[#3C3B39] py-24 text-[#FBE9CB]">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">Artikel</p>
            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight">
                Cerita, inspirasi, dan edukasi batik.
            </h1>
        </div>
    </section>

    <section class="py-24">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-8 md:grid-cols-3">
                @foreach ($articles as $article)
                    <article class="overflow-hidden rounded-[2rem] border border-[#E6D8C8] bg-white shadow-sm">
                        <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/frontend/hero-product.jpg') }}"
                            class="h-64 w-full object-cover" alt="{{ $article->title }}">

                        <div class="p-6">
                            <p class="text-xs font-black uppercase tracking-[0.2em] text-[#8A3F35]">
                                {{ $article->category ?: 'Batik Insight' }}
                            </p>

                            <h2 class="mt-3 font-['Playfair_Display'] text-2xl font-black leading-tight text-[#3C3B39]">
                                {{ $article->title }}
                            </h2>

                            <p class="mt-3 text-sm leading-7 text-[#7F756D]">
                                {{ $article->excerpt }}
                            </p>

                            <a href="{{ route('articles.show', $article) }}"
                                class="mt-5 inline-flex text-sm font-black text-[#8A3F35]">
                                Baca Artikel →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
@endsection
