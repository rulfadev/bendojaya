<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::query()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.articles.index', [
            'title' => 'Artikel',
            'subtitle' => 'Kelola artikel, inspirasi, dan edukasi batik.',
            'articles' => $articles,
        ]);
    }

    public function create(): View
    {
        return view('admin.articles.create', [
            'title' => 'Tambah Artikel',
            'subtitle' => 'Buat artikel baru untuk website.',
            'article' => new Article([
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 0,
                'published_at' => now(),
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateArticle($request);

        $validated['slug'] = $this->makeUniqueSlug($validated['slug'] ?? $validated['title']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        Article::query()->create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.edit', [
            'title' => 'Edit Artikel',
            'subtitle' => 'Perbarui artikel website.',
            'article' => $article,
        ]);
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $this->validateArticle($request, $article);

        $validated['slug'] = $this->makeUniqueSlug($validated['slug'] ?? $validated['title'], $article->id);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }

            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }

    private function validateArticle(Request $request, ?Article $article = null): array
    {
        return $request->validate(
            [
                'title' => ['required', 'string', 'max:180'],
                'slug' => [
                    'nullable',
                    'string',
                    'max:220',
                    Rule::unique('articles', 'slug')->ignore($article?->id),
                ],
                'category' => ['nullable', 'string', 'max:150'],
                'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
                'excerpt' => ['nullable', 'string'],
                'content' => ['nullable', 'string'],

                'meta_title' => ['nullable', 'string', 'max:180'],
                'meta_description' => ['nullable', 'string'],
                'meta_keywords' => ['nullable', 'string'],

                'sort_order' => ['nullable', 'integer', 'min:0'],
                'published_at' => ['nullable', 'date'],
                'is_featured' => ['nullable', 'boolean'],
                'is_active' => ['nullable', 'boolean'],
            ],
            [
                'title.required' => 'Judul artikel wajib diisi.',
                'slug.unique' => 'Slug artikel sudah digunakan.',
                'featured_image.image' => 'Gambar harus berupa file gambar.',
                'featured_image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
                'featured_image.max' => 'Ukuran gambar maksimal 4MB.',
            ]
        );
    }

    private function makeUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Article::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
