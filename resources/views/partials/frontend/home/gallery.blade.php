@php
    $defaultImage = asset('assets/frontend/hero-product.jpg');
    $galleryItems = collect($galleries ?? []);
@endphp

<section id="gallery" class="bg-[#3C3B39] py-24 text-[#FBE9CB] lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="mb-14 grid gap-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-end">
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
                    $span = $loop->first ? 'md:col-span-2' : '';
                    $height = $loop->first ? 'h-[520px]' : 'h-[250px] md:h-[520px]';
                @endphp

                <a href="{{ route('galleries.show', $gallery) }}"
                    class="{{ $span }} group overflow-hidden rounded-[2.5rem]">
                    <img src="{{ $image }}" alt="{{ $gallery->title }}"
                        class="{{ $height }} w-full rounded-[2.5rem] object-cover transition duration-700 group-hover:scale-105">
                </a>
            @empty
                <div class="md:col-span-2">
                    <img src="{{ $defaultImage }}" class="h-[520px] w-full rounded-[2.5rem] object-cover object-left"
                        alt="Gallery">
                </div>

                <img src="{{ $defaultImage }}" class="h-[520px] w-full rounded-[2.5rem] object-cover object-center"
                    alt="Gallery">
                <img src="{{ $defaultImage }}" class="h-[520px] w-full rounded-[2.5rem] object-cover object-right"
                    alt="Gallery">
            @endforelse
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('galleries.index') }}"
                class="inline-flex rounded-full border border-[#FBE9CB]/35 px-7 py-4 text-sm font-black text-[#FBE9CB] transition hover:-translate-y-1 hover:bg-white/10">
                Lihat Semua Gallery
            </a>
        </div>
    </div>
</section>
