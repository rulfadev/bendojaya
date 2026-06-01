@extends('layouts.admin')

@section('content')
    <div class="grid gap-6 xl:grid-cols-3">
        <section class="xl:col-span-2">
            <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-stone-950 shadow-xl shadow-stone-900/10">
                <div class="relative p-8 sm:p-10">
                    <div class="absolute inset-0 opacity-20"
                        style="background-image: radial-gradient(circle at 2px 2px, #fbbf24 1px, transparent 0); background-size: 30px 30px;">
                    </div>

                    <div class="relative">
                        <p class="text-xs font-black uppercase tracking-[0.3em] text-amber-300">Bendo Jaya CMS</p>
                        <h1 class="mt-4 max-w-2xl text-3xl font-black leading-tight tracking-tight text-white sm:text-5xl">
                            Kelola identitas batik, gallery, artikel, dan koleksi dari satu tempat.
                        </h1>
                        <p class="mt-5 max-w-2xl text-sm leading-7 text-stone-300 sm:text-base">
                            Fondasi admin sudah aktif. Setelah pengaturan website selesai, modul berikutnya bisa masuk ke
                            artikel, gallery, koleksi, partner, dan custom page.
                        </p>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="{{ route('admin.site-settings.index') }}"
                                class="rounded-2xl bg-amber-300 px-5 py-3 text-sm font-black text-stone-950 transition hover:bg-amber-200">
                                Atur Website
                            </a>

                            <a href="{{ route('home') }}" target="_blank"
                                class="rounded-2xl border border-white/15 bg-white/10 px-5 py-3 text-sm font-black text-white transition hover:bg-white/15">
                                Lihat Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Identitas Website</p>

            <div class="mt-5">
                @if ($setting->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->site_name }}"
                        class="mb-5 max-h-16 rounded-2xl object-contain">
                @else
                    <div
                        class="mb-5 flex h-16 w-16 items-center justify-center rounded-3xl bg-stone-950 text-xl font-black text-amber-300">
                        BJ
                    </div>
                @endif

                <h2 class="text-2xl font-black text-stone-950">{{ $setting->site_name }}</h2>
                <p class="mt-2 text-sm font-semibold text-amber-800">{{ $setting->tagline ?? 'Tagline belum diatur' }}</p>
                <p class="mt-4 text-sm leading-7 text-stone-500">
                    {{ $setting->short_description ?? 'Deskripsi singkat website belum diatur.' }}
                </p>
            </div>
        </section>
    </div>

    <section class="mt-8 grid gap-5 sm:grid-cols-2 xl:grid-cols-5">
        @foreach ($stats as $stat)
            <div
                class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl hover:shadow-stone-900/5">
                <div
                    class="mb-6 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-xl font-black text-amber-800">
                    {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                </div>

                <p class="text-3xl font-black text-stone-950">{{ $stat['value'] }}</p>
                <h3 class="mt-2 text-sm font-black uppercase tracking-[0.15em] text-stone-700">{{ $stat['label'] }}</h3>
                <p class="mt-3 text-sm leading-6 text-stone-500">{{ $stat['description'] }}</p>
            </div>
        @endforeach
    </section>

    <section class="mt-8 grid gap-6 lg:grid-cols-2">
        <div class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Roadmap Modul</p>
                <h2 class="mt-2 text-xl font-black text-stone-950">Tahapan CMS Bendo Jaya</h2>
            </div>

            <div class="space-y-4">
                @foreach ([['title' => 'Pengaturan Website', 'status' => 'Aktif'], ['title' => 'Artikel dan Kategori Artikel', 'status' => 'Berikutnya'], ['title' => 'Gallery dan Kategori Gallery', 'status' => 'Segera'], ['title' => 'Koleksi Produk Batik', 'status' => 'Segera'], ['title' => 'Partner / Kerja Sama Brand', 'status' => 'Segera'], ['title' => 'Custom Page', 'status' => 'Segera']] as $item)
                    <div
                        class="flex items-center justify-between rounded-3xl border border-stone-200 bg-white/70 px-5 py-4">
                        <div>
                            <p class="font-black text-stone-900">{{ $item['title'] }}</p>
                            <p class="mt-1 text-xs font-semibold uppercase tracking-wider text-stone-400">CMS Module</p>
                        </div>

                        <span class="rounded-full bg-stone-950 px-3 py-1 text-xs font-black text-amber-200">
                            {{ $item['status'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Catatan Desain</p>
                <h2 class="mt-2 text-xl font-black text-stone-950">Arah Visual Website</h2>
            </div>

            <div class="space-y-4 text-sm leading-7 text-stone-600">
                <p>
                    Admin panel menggunakan warna dasar cream, coklat gelap, dan amber agar terasa hangat, tradisional, tapi
                    tetap modern.
                </p>
                <p>
                    Motif titik halus digunakan sebagai interpretasi visual batik tanpa membuat tampilan terlalu ramai.
                </p>
                <p>
                    Nanti frontend publik bisa dibuat lebih editorial: hero besar, gallery kain, koleksi pakaian, artikel
                    edukasi, dan CTA kerja sama.
                </p>
            </div>
        </div>
    </section>
@endsection
