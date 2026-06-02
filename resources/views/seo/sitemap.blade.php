{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>

    @foreach ($pages as $page)
        <url>
            <loc>{{ route('pages.show', $page) }}</loc>
            <lastmod>{{ ($page->updated_at ?? now())->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    <url>
        <loc>{{ route('collections.index') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach ($collections ?? [] as $collection)
        <url>
            <loc>{{ route('collections.show', $collection) }}</loc>
            <lastmod>{{ ($collection->updated_at ?? now())->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    <url>
        <loc>{{ route('galleries.index') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach ($galleries ?? [] as $gallery)
        <url>
            <loc>{{ route('galleries.show', $gallery) }}</loc>
            <lastmod>{{ ($gallery->updated_at ?? now())->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>
