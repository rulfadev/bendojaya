@extends('layouts.frontend')

@section('content')
    @php
        $defaultImage = asset('assets/frontend/hero-product.jpg');
        $image = $page->featured_image ? asset('storage/' . $page->featured_image) : $defaultImage;
    @endphp

    @if ($page->activeSections->isNotEmpty())
        @foreach ($page->activeSections as $section)
            @includeIf('partials.frontend.page-sections.' . $section->type, [
                'section' => $section,
                'page' => $page,
            ])
        @endforeach
    @else
        <section class="relative overflow-hidden bg-[#3C3B39] py-28 text-[#FBE9CB]">
            <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('{{ $image }}');">
            </div>

            <div class="absolute inset-0 bg-[#3C3B39]/75"></div>

            <div class="relative mx-auto max-w-5xl px-5 text-center lg:px-8">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">Bendo Jaya</p>

                <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight sm:text-6xl">
                    {{ $page->title }}
                </h1>

                @if ($page->excerpt)
                    <p class="mx-auto mt-6 max-w-3xl text-base leading-8 text-[#E6D8C8]">
                        {{ $page->excerpt }}
                    </p>
                @endif
            </div>
        </section>

        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-4xl px-5 lg:px-8">
                <article class="rounded-[2rem] border border-[#E6D8C8] bg-white/80 p-7 text-[#58433D] shadow-sm sm:p-10">
                    <div class="space-y-6 text-base leading-8">
                        {!! $page->content ?: '<p>Konten halaman belum tersedia.</p>' !!}
                    </div>
                </article>
            </div>
        </section>
    @endif
@endsection
