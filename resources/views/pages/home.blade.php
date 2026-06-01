@extends('layouts.frontend')

@section('content')
    @php
        $heroImage = asset('assets/frontend/hero-product.jpg');
        $whatsapp = $setting?->whatsapp_number ?? '6280000000000';

        $collections = [
            [
                'name' => 'Batik Dress Coklat Klasik',
                'category' => 'Signature Collection',
                'desc' => 'Nuansa coklat hangat dengan motif batik klasik untuk tampilan harian yang anggun.',
            ],
            [
                'name' => 'Batik Dress Abu Natural',
                'category' => 'Soft Traditional',
                'desc' => 'Warna natural dengan karakter lembut, cocok untuk gaya santai maupun semi-formal.',
            ],
            [
                'name' => 'Batik Dress Maroon Elegan',
                'category' => 'Elegant Series',
                'desc' => 'Pilihan warna maroon yang tegas, feminin, dan tetap membawa sentuhan tradisional.',
            ],
        ];

        $services = [
            'Koleksi batik wanita ready to wear',
            'Custom pakaian dan seragam batik',
            'Kerja sama brand fashion dan komunitas',
        ];

        $articles = [
            'Mengenal Karakter Motif Batik dalam Fashion Modern',
            'Cara Merawat Pakaian Batik agar Tetap Indah',
        ];
    @endphp

    {{-- HERO --}}
    <section id="home" class="relative min-h-[calc(100vh-80px)] overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: linear-gradient(90deg, rgba(60, 59, 57, 0.92) 0%, rgba(60, 59, 57, 0.72) 42%, rgba(60, 59, 57, 0.28) 100%), url('{{ $heroImage }}');">
        </div>

        <div class="absolute inset-0 opacity-[0.12]"
            style="background-image: radial-gradient(circle at 1px 1px, #FBE9CB 1px, transparent 0); background-size: 28px 28px;">
        </div>

        <div class="relative mx-auto flex min-h-[calc(100vh-80px)] max-w-7xl items-center px-5 py-24 lg:px-8">
            <div class="max-w-3xl">
                <div
                    class="mb-8 inline-flex rounded-full border border-[#FBE9CB]/25 bg-[#FBE9CB]/10 px-5 py-2 text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5] backdrop-blur">
                    Bendo Jaya Batik Fashion
                </div>

                <h1
                    class="font-['Playfair_Display'] text-5xl font-black leading-[1.05] tracking-tight text-[#FBE9CB] sm:text-6xl lg:text-7xl">
                    Batik Elegan untuk Gaya yang Lebih Berkarakter.
                </h1>

                <p class="mt-7 max-w-2xl text-base leading-8 text-[#E6D8C8] sm:text-lg">
                    Koleksi batik wanita dengan sentuhan tradisional, warna hangat, dan desain nyaman untuk daily wear,
                    custom seragam, maupun kerja sama brand fashion.
                </p>

                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#collection"
                        class="inline-flex justify-center rounded-full bg-[#FBE9CB] px-8 py-4 text-sm font-black text-[#3C3B39] shadow-xl shadow-black/10 transition hover:-translate-y-1 hover:bg-white">
                        Lihat Koleksi
                    </a>

                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                        class="inline-flex justify-center rounded-full border border-[#FBE9CB]/35 bg-white/5 px-8 py-4 text-sm font-black text-[#FBE9CB] backdrop-blur transition hover:-translate-y-1 hover:bg-white/10">
                        Konsultasi Kerja Sama
                    </a>
                </div>

                <div class="mt-14 grid max-w-2xl gap-4 border-t border-[#FBE9CB]/20 pt-8 sm:grid-cols-3">
                    <div>
                        <p class="font-['Playfair_Display'] text-3xl font-black text-[#FBE9CB]">100+</p>
                        <p class="mt-1 text-xs font-bold uppercase tracking-[0.2em] text-[#EEBDB5]">Koleksi</p>
                    </div>

                    <div>
                        <p class="font-['Playfair_Display'] text-3xl font-black text-[#FBE9CB]">Custom</p>
                        <p class="mt-1 text-xs font-bold uppercase tracking-[0.2em] text-[#EEBDB5]">Produksi</p>
                    </div>

                    <div>
                        <p class="font-['Playfair_Display'] text-3xl font-black text-[#FBE9CB]">Brand</p>
                        <p class="mt-1 text-xs font-bold uppercase tracking-[0.2em] text-[#EEBDB5]">Partner</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- VALUE STRIP --}}
    <section class="border-y border-[#E6D8C8] bg-[#FFF8ED]">
        <div
            class="mx-auto flex max-w-7xl flex-wrap items-center justify-center gap-x-8 gap-y-3 px-5 py-5 text-center text-xs font-black uppercase tracking-[0.25em] text-[#765A4F] lg:px-8">
            <span>Batik Fashion</span>
            <span class="text-[#EEBDB5]">•</span>
            <span>Daily Wear</span>
            <span class="text-[#EEBDB5]">•</span>
            <span>Custom Dress</span>
            <span class="text-[#EEBDB5]">•</span>
            <span>Brand Collaboration</span>
            <span class="text-[#EEBDB5]">•</span>
            <span>Traditional Motif</span>
        </div>
    </section>

    {{-- ABOUT --}}
    <section id="about" class="py-24 lg:py-32">
        <div class="mx-auto grid max-w-7xl items-center gap-14 px-5 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
            <div class="relative">
                <div class="absolute -left-6 -top-6 h-40 w-40 rounded-full bg-[#EEBDB5]/40 blur-3xl"></div>

                <div
                    class="relative overflow-hidden rounded-[2.5rem] border border-[#E6D8C8] bg-white p-3 shadow-2xl shadow-[#3C3B39]/10">
                    <img src="{{ $heroImage }}" alt="Tentang Bendo Jaya Batik Fashion"
                        class="h-[620px] w-full rounded-[2rem] object-cover object-left">
                </div>

                <div
                    class="absolute -bottom-8 right-8 hidden max-w-xs rounded-[2rem] border border-[#E6D8C8] bg-[#FFF8ED] p-6 shadow-2xl shadow-[#3C3B39]/10 sm:block">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">Signature Style</p>
                    <p class="mt-3 font-['Playfair_Display'] text-2xl font-black leading-tight text-[#3C3B39]">
                        Warm, feminine, and traditional.
                    </p>
                </div>
            </div>

            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">Tentang Bendo Jaya</p>

                <h2
                    class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl lg:text-6xl">
                    Menghadirkan batik dengan rasa hangat, lembut, dan elegan.
                </h2>

                <p class="mt-7 text-base leading-8 text-[#7F756D]">
                    Bendo Jaya Batik Fashion menghadirkan koleksi pakaian batik dengan karakter tradisional dan tampilan
                    modern. Kami percaya batik tidak hanya menjadi pakaian formal, tetapi juga bagian dari gaya harian yang
                    nyaman, indah, dan berkarakter.
                </p>

                <div class="mt-10 space-y-6 border-l border-[#D8C5AF] pl-6">
                    <div>
                        <h3 class="text-lg font-black text-[#3C3B39]">Produksi yang Rapi</h3>
                        <p class="mt-2 text-sm leading-7 text-[#7F756D]">
                            Setiap koleksi dipersiapkan dengan perhatian pada potongan, kenyamanan, dan detail visual.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-black text-[#3C3B39]">Motif Bernuansa Tradisional</h3>
                        <p class="mt-2 text-sm leading-7 text-[#7F756D]">
                            Mengangkat karakter batik dengan warna hangat yang mudah dipadukan untuk berbagai kebutuhan.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-black text-[#3C3B39]">Siap untuk Kerja Sama</h3>
                        <p class="mt-2 text-sm leading-7 text-[#7F756D]">
                            Terbuka untuk custom pakaian, seragam, komunitas, hingga pengembangan koleksi bersama brand.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SERVICES --}}
    <section id="services" class="bg-[#F6EFE4] py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:items-end">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">Layanan</p>
                    <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                        Bukan hanya menjual koleksi, kami membangun cerita lewat batik.
                    </h2>
                </div>

                <p class="text-base leading-8 text-[#7F756D]">
                    Website ini menjadi ruang untuk menampilkan karya, koleksi, gallery, artikel, dan peluang kerja sama.
                    E-commerce dapat dikembangkan setelah fondasi brand dan katalog visualnya matang.
                </p>
            </div>

            <div class="mt-14 divide-y divide-[#D8C5AF] border-y border-[#D8C5AF]">
                @foreach ($services as $service)
                    <div class="grid gap-5 py-8 sm:grid-cols-[120px_1fr_auto] sm:items-center">
                        <p class="font-['Playfair_Display'] text-4xl font-black text-[#C99A4A]">
                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </p>

                        <h3 class="text-2xl font-black text-[#3C3B39]">
                            {{ $service }}
                        </h3>

                        <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                            class="inline-flex text-sm font-black text-[#8A3F35] transition hover:text-[#3C3B39]">
                            Konsultasi →
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FEATURED COLLECTION --}}
    <section id="collection" class="py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="mb-14 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">Koleksi Pilihan</p>
                    <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                        Koleksi batik dengan warna hangat dan motif berkarakter.
                    </h2>
                </div>

                <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                    class="inline-flex rounded-full border border-[#765A4F] px-7 py-4 text-sm font-black text-[#765A4F] transition hover:bg-[#765A4F] hover:text-white">
                    Tanya Koleksi
                </a>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                @foreach ($collections as $collection)
                    <article class="group">
                        <div class="overflow-hidden rounded-[2.5rem] bg-[#F6EFE4] p-3">
                            <img src="{{ $heroImage }}" alt="{{ $collection['name'] }}"
                                class="h-[520px] w-full rounded-[2rem] object-cover transition duration-700 group-hover:scale-105
                                 {{ $loop->iteration === 1 ? 'object-left' : ($loop->iteration === 2 ? 'object-center' : 'object-right') }}">
                        </div>

                        <div class="pt-6">
                            <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                                {{ $collection['category'] }}
                            </p>

                            <h3 class="mt-3 font-['Playfair_Display'] text-3xl font-black text-[#3C3B39]">
                                {{ $collection['name'] }}
                            </h3>

                            <p class="mt-3 text-sm leading-7 text-[#7F756D]">
                                {{ $collection['desc'] }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- GALLERY --}}
    <section id="gallery" class="bg-[#3C3B39] py-24 text-[#FBE9CB] lg:py-32">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="mb-14 grid gap-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-end">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">Gallery</p>
                    <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight sm:text-5xl">
                        Detail motif, koleksi, dan cerita visual Bendo Jaya.
                    </h2>
                </div>

                <p class="text-sm leading-7 text-[#E6D8C8]">
                    Gallery menjadi ruang untuk memperlihatkan detail produk, dokumentasi pemotretan, dan proses kreatif
                    yang membentuk karakter Bendo Jaya Batik Fashion.
                </p>
            </div>

            <div class="grid gap-5 md:grid-cols-4">
                <div class="md:col-span-2">
                    <img src="{{ $heroImage }}" alt="Gallery Bendo Jaya"
                        class="h-[520px] w-full rounded-[2.5rem] object-cover object-left">
                </div>

                <div class="space-y-5">
                    <img src="{{ $heroImage }}" alt="Gallery Bendo Jaya"
                        class="h-[250px] w-full rounded-[2rem] object-cover object-center">

                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-7">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-[#EEBDB5]">Visual Identity</p>
                        <p class="mt-4 font-['Playfair_Display'] text-2xl font-black leading-tight text-[#FBE9CB]">
                            Batik yang terasa lembut, hangat, dan mudah dikenakan.
                        </p>
                    </div>
                </div>

                <div>
                    <img src="{{ $heroImage }}" alt="Gallery Bendo Jaya"
                        class="h-[520px] w-full rounded-[2.5rem] object-cover object-right">
                </div>
            </div>
        </div>
    </section>

    {{-- PARTNER --}}
    <section class="py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div
                class="grid overflow-hidden rounded-[2.5rem] border border-[#E6D8C8] bg-[#F6EFE4] lg:grid-cols-[1.1fr_0.9fr]">
                <div class="p-8 sm:p-12 lg:p-16">
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">Kerja Sama</p>

                    <h2
                        class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                        Terbuka untuk brand, komunitas, dan kebutuhan custom.
                    </h2>

                    <p class="mt-6 text-base leading-8 text-[#7F756D]">
                        Bendo Jaya dapat menjadi partner untuk kebutuhan koleksi fashion, custom pakaian batik, seragam
                        komunitas, maupun pengembangan produk bersama brand.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        @foreach (['Fashion Brand', 'Komunitas', 'Instansi', 'Custom Production'] as $item)
                            <span
                                class="rounded-full border border-[#D8C5AF] bg-white/70 px-5 py-2 text-xs font-black uppercase tracking-[0.18em] text-[#765A4F]">
                                {{ $item }}
                            </span>
                        @endforeach
                    </div>

                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                        class="mt-10 inline-flex rounded-full bg-[#3C3B39] px-8 py-4 text-sm font-black text-[#FBE9CB] transition hover:bg-[#58433D]">
                        Ajukan Kerja Sama
                    </a>
                </div>

                <div class="relative min-h-[420px]">
                    <img src="{{ $heroImage }}" alt="Kerja sama Bendo Jaya"
                        class="absolute inset-0 h-full w-full object-cover object-right">
                </div>
            </div>
        </div>
    </section>

    {{-- ARTICLES --}}
    <section id="articles" class="bg-[#FFF8ED] pb-24 lg:pb-32">
        <div class="mx-auto max-w-7xl border-t border-[#E6D8C8] px-5 pt-20 lg:px-8">
            <div class="mb-12 max-w-2xl">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">Artikel</p>
                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    Cerita, inspirasi, dan edukasi batik.
                </h2>
            </div>

            <div class="grid gap-8 lg:grid-cols-2">
                @foreach ($articles as $article)
                    <article
                        class="grid overflow-hidden rounded-[2rem] border border-[#E6D8C8] bg-white shadow-sm sm:grid-cols-[0.85fr_1.15fr]">
                        <img src="{{ $heroImage }}" alt="{{ $article }}"
                            class="h-72 w-full object-cover {{ $loop->first ? 'object-left' : 'object-right' }} sm:h-full">

                        <div class="p-7">
                            <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">Batik Insight</p>

                            <h3 class="mt-4 font-['Playfair_Display'] text-2xl font-black leading-tight text-[#3C3B39]">
                                {{ $article }}
                            </h3>

                            <p class="mt-4 text-sm leading-7 text-[#7F756D]">
                                Inspirasi singkat seputar batik, gaya berpakaian, dan cara menjaga koleksi tetap indah.
                            </p>

                            <a href="#" class="mt-6 inline-flex text-sm font-black text-[#8A3F35]">
                                Baca Artikel →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section id="contact" class="pb-24 lg:pb-32">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div
                class="relative overflow-hidden rounded-[2.5rem] bg-[#3C3B39] px-8 py-20 text-center text-[#FBE9CB] lg:px-16">
                <div class="absolute inset-0 opacity-[0.1]"
                    style="background-image: radial-gradient(circle at 1px 1px, #FBE9CB 1px, transparent 0); background-size: 28px 28px;">
                </div>

                <div class="relative mx-auto max-w-3xl">
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">Konsultasi</p>

                    <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight sm:text-5xl">
                        Ingin membuat koleksi batik untuk brand Anda?
                    </h2>

                    <p class="mx-auto mt-6 max-w-2xl text-sm leading-7 text-[#E6D8C8]">
                        Diskusikan kebutuhan custom pakaian, seragam, koleksi fashion, atau kerja sama brand bersama Bendo
                        Jaya.
                    </p>

                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                        class="mt-9 inline-flex rounded-full bg-[#FBE9CB] px-8 py-4 text-sm font-black text-[#3C3B39] transition hover:bg-white">
                        Konsultasi via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
