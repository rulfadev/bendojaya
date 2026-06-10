@php
    $articleItems = collect($articles ?? []);
    $isEnglish = app()->getLocale() === 'en';

    $getText = function ($item, string $field, mixed $fallback = null) {
        if (is_object($item) && method_exists($item, 'translated')) {
            return $item->translated($field, null, data_get($item, $field, $fallback));
        }

        return data_get($item, $field, $fallback);
    };

    $articlesIndexUrl =
        $isEnglish && \Illuminate\Support\Facades\Route::has('en.articles.index')
            ? route('en.articles.index')
            : route('articles.index');

    $articleShowUrl = function ($article) use ($isEnglish) {
        if ($isEnglish && \Illuminate\Support\Facades\Route::has('en.articles.show')) {
            return route('en.articles.show', $article);
        }

        return route('articles.show', $article);
    };
@endphp

<section id="articles" class="bg-[#FFF8ED] pb-24 lg:pb-32">
    <div class="mx-auto max-w-7xl border-b border-[#E6D8C8] px-5 py-20 lg:px-8">
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

            <a href="{{ $articlesIndexUrl }}" class="text-sm font-black text-[#8A3F35]">
                {{ __('frontend.view_all_articles') }} <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid gap-8 lg:grid-cols-2">
            @forelse ($articleItems as $article)
                @php
                    $title = $getText($article, 'title', 'Artikel Bendo Jaya');
                    $category = $getText($article, 'category', 'Batik Insight');
                    $excerpt = $getText($article, 'excerpt', 'Inspirasi singkat seputar batik dan fashion.');

                    $featuredImage = data_get($article, 'featured_image');
                    $image = $featuredImage
                        ? asset('storage/' . $featuredImage)
                        : asset('assets/frontend/hero-product.jpg');

                    $url = data_get($article, 'slug') ? $articleShowUrl($article) : $articlesIndexUrl;
                @endphp

                <article
                    class="group grid overflow-hidden rounded-[2.5rem] border border-[#E6D8C8] bg-white p-3 shadow-sm transition hover:-translate-y-1 hover:shadow-xl sm:grid-cols-[0.85fr_1.15fr]">
                    <div class="overflow-hidden rounded-[2rem]">
                        <img src="{{ $image }}" alt="{{ $title }}"
                            class="h-64 w-full object-cover transition duration-700 group-hover:scale-105 sm:h-full">
                    </div>

                    <div class="p-5 sm:p-7">
                        <div class="mb-5 flex items-center justify-between">
                            <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                                {{ $category }}
                            </p>

                            <span class="h-px flex-1 bg-[#E6D8C8] ml-4"></span>
                        </div>

                        <h3 class="font-['Playfair_Display'] text-2xl font-black leading-tight text-[#3C3B39]">
                            {{ $title }}
                        </h3>

                        <p class="mt-4 text-sm leading-7 text-[#7F756D]">
                            {{ $excerpt }}
                        </p>

                        <a href="{{ $url }}"
                            class="mt-7 inline-flex items-center gap-3 rounded-full border border-[#765A4F]/35 px-5 py-3 text-sm font-black text-[#765A4F] transition hover:bg-[#765A4F] hover:text-white">
                            {{ __('frontend.read_article') }}
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </article>
            @empty
                <p class="text-stone-500">{{ __('frontend.no_articles') }}</p>
            @endforelse
        </div>
    </div>
</section>
