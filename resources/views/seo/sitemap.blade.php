<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>

    @if (Route::has('collections.index'))
        <url>
            <loc>{{ route('collections.index') }}</loc>
            <lastmod>{{ now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endif

    @if (Route::has('galleries.index'))
        <url>
            <loc>{{ route('galleries.index') }}</loc>
            <lastmod>{{ now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endif

    @if (Route::has('articles.index'))
        <url>
            <loc>{{ route('articles.index') }}</loc>
            <lastmod>{{ now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endif

    @if (Route::has('faqs.index'))
        <url>
            <loc>{{ route('faqs.index') }}</loc>
            <lastmod>{{ now()->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endif

    @isset($pages)
        @foreach ($pages as $page)
            <url>
                <loc>{{ route('pages.show', $page) }}</loc>
                <lastmod>{{ $page->updated_at?->toAtomString() ?? now()->toAtomString() }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.7</priority>
            </url>
        @endforeach
    @endisset

    @isset($collections)
        @foreach ($collections as $collection)
            <url>
                <loc>{{ route('collections.show', $collection) }}</loc>
                <lastmod>{{ $collection->updated_at?->toAtomString() ?? now()->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endisset

    @isset($galleries)
        @foreach ($galleries as $gallery)
            <url>
                <loc>{{ route('galleries.show', $gallery) }}</loc>
                <lastmod>{{ $gallery->updated_at?->toAtomString() ?? now()->toAtomString() }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.6</priority>
            </url>
        @endforeach
    @endisset

    @isset($articles)
        @foreach ($articles as $article)
            <url>
                <loc>{{ route('articles.show', $article) }}</loc>
                <lastmod>{{ $article->updated_at?->toAtomString() ?? now()->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.7</priority>
            </url>
        @endforeach
    @endisset
</urlset>
