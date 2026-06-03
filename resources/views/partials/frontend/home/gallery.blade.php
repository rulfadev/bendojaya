@php
    $defaultImage = asset('assets/frontend/hero-product.jpg');
    $galleryItems = collect($galleries ?? []);
@endphp

<section id="gallery" class="bg-[#3C3B39] py-24 text-[#FBE9CB] lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="mb-14 grid gap-8 lg:grid-cols-[0.85fr_1.15fr] lg:items-end">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                    {{ $homepage?->gallery_eyebrow ?: 'Gallery' }}
                </p>

                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight sm:text-5xl">
                    {{ $homepage?->gallery_title ?: 'Detail motif, koleksi, dan cerita visual Bendo Jaya.' }}
                </h2>
            </div>

            <p class="text-sm leading-7 text-[#E6D8C8]">
                {{ $homepage?->gallery_description ?: 'Dokumentasi produk, motif, photoshoot, dan proses kreatif Bendo Jaya Batik Fashion.' }}
            </p>
        </div>

        <div class="grid gap-5 md:grid-cols-4">
            @forelse ($galleryItems as $gallery)
                @php
                    $image = $gallery->image ? asset('storage/' . $gallery->image) : $defaultImage;
                    $span = $loop->first ? 'md:col-span-2 md:row-span-2' : '';
                    $height = $loop->first ? 'h-[520px] md:h-full' : 'h-full';
                @endphp

                <a href="{{ route('galleries.show', $gallery) }}"
                    class="{{ $span }} group relative overflow-hidden rounded-[2.25rem] bg-white/5 p-2 transition hover:-translate-y-1">
                    <img src="{{ $image }}" alt="{{ $gallery->title }}"
                        class="{{ $height }} w-full rounded-[1.8rem] object-cover transition duration-700 group-hover:scale-105">

                    <div
                        class="absolute inset-x-2 bottom-2 rounded-b-[1.8rem] bg-gradient-to-t from-[#2F2D2B]/90 via-[#2F2D2B]/45 to-transparent p-5 pt-20 opacity-100 transition">
                        <p class="text-xs font-black uppercase tracking-[0.22em] text-[#EEBDB5]">
                            {{ $gallery->category ?: 'Gallery' }}
                        </p>

                        <h3 class="mt-2 font-['Playfair_Display'] text-2xl font-black text-[#FBE9CB]">
                            {{ $gallery->title }}
                        </h3>

                        <span class="mt-4 inline-flex items-center gap-2 text-sm font-black text-[#FBE9CB]">
                            Lihat Detail
                            <i class="fa-solid fa-arrow-right text-xs transition group-hover:translate-x-1"></i>
                        </span>
                    </div>
                </a>
            @empty
                <div class="rounded-[2rem] border border-[#FBE9CB]/15 bg-white/5 p-10 text-[#E6D8C8] md:col-span-4">
                    Belum ada gallery aktif.
                </div>
            @endforelse
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('galleries.index') }}"
                class="inline-flex items-center gap-3 rounded-full border border-[#FBE9CB]/35 px-7 py-4 text-sm font-black text-[#FBE9CB] transition hover:-translate-y-1 hover:bg-white/10">
                Lihat Semua Gallery
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>
