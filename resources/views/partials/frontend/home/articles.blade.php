@php
    $articleItems = collect($articles ?? []);
@endphp

<section id="articles" class="bg-[#FFF8ED] pb-24 lg:pb-32">
    <div class="mx-auto max-w-7xl border-t border-[#E6D8C8] px-5 pt-20 lg:px-8">
        <div class="mb-12 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                    {{ $homepage?->articles_eyebrow ?: 'Artikel' }}
                </p>

                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    {{ $homepage?->articles_title ?: 'Cerita, inspirasi, dan edukasi batik.' }}
                </h2>

                @if ($homepage?->articles_description)
                    <p class="mt-5 text-base leading-8 text-[#7F756D]">
                        {{ $homepage->articles_description }}
                    </p>
                @endif
            </div>

            <a href="{{ route('articles.index') }}" class="text-sm font-black text-[#8A3F35]">
                Lihat Semua Artikel →
            </a>
        </div>

        <div class="grid gap-8 lg:grid-cols-2">
            @forelse ($articleItems as $article)
                @php
                    $title = data_get($article, 'title', 'Artikel Bendo Jaya');
                    $category = data_get($article, 'category', 'Batik Insight');
                    $excerpt = data_get($article, 'excerpt', 'Inspirasi singkat seputar batik dan fashion.');
                    $featuredImage = data_get($article, 'featured_image');
                    $image = $featuredImage
                        ? asset('storage/' . $featuredImage)
                        : asset('assets/frontend/hero-product.jpg');
                    $url = data_get($article, 'slug') ? route('articles.show', $article) : route('articles.index');
                @endphp

                <article
                    class="grid overflow-hidden rounded-[2rem] border border-[#E6D8C8] bg-white shadow-sm sm:grid-cols-[0.85fr_1.15fr]">
                    <img src="{{ $image }}" alt="{{ $title }}" class="h-72 w-full object-cover sm:h-full">

                    <div class="p-7">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                            {{ $category }}
                        </p>

                        <h3 class="mt-4 font-['Playfair_Display'] text-2xl font-black leading-tight text-[#3C3B39]">
                            {{ $title }}
                        </h3>

                        <p class="mt-4 text-sm leading-7 text-[#7F756D]">
                            {{ $excerpt }}
                        </p>

                        <a href="{{ $url }}" class="mt-6 inline-flex text-sm font-black text-[#8A3F35]">
                            Baca Artikel →
                        </a>
                    </div>
                </article>
            @empty
                <p class="text-stone-500">Belum ada artikel.</p>
            @endforelse
        </div>
    </div>
</section>
