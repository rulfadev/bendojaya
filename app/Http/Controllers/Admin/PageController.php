<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $pages = Page::query()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.pages.index', [
            'title' => 'Custom Page',
            'subtitle' => 'Kelola halaman custom seperti kerja sama, cara pemesanan, FAQ, dan halaman informasi lainnya.',
            'pages' => $pages,
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.create', [
            'title' => 'Tambah Custom Page',
            'subtitle' => 'Buat halaman custom baru.',
            'page' => new Page([
                'is_active' => true,
                'show_in_navigation' => false,
                'sort_order' => 0,
                'published_at' => now(),
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePage($request);

        $validated['slug'] = $this->makeUniqueSlug($validated['slug'] ?? $validated['title']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['show_in_navigation'] = $request->boolean('show_in_navigation');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('pages', 'public');
        }

        Page::query()->create($validated);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Custom page berhasil ditambahkan.');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.edit', [
            'title' => 'Edit Custom Page',
            'subtitle' => 'Perbarui halaman custom website.',
            'page' => $page,
        ]);
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $this->validatePage($request, $page);

        $validated['slug'] = $this->makeUniqueSlug($validated['slug'] ?? $validated['title'], $page->id);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['show_in_navigation'] = $request->boolean('show_in_navigation');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('featured_image')) {
            if ($page->featured_image) {
                Storage::disk('public')->delete($page->featured_image);
            }

            $validated['featured_image'] = $request->file('featured_image')->store('pages', 'public');
        }

        $page->update($validated);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Custom page berhasil diperbarui.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        if ($page->featured_image) {
            Storage::disk('public')->delete($page->featured_image);
        }

        $page->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Custom page berhasil dihapus.');
    }

    private function validatePage(Request $request, ?Page $page = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => [
                'nullable',
                'string',
                'max:220',
                Rule::unique('pages', 'slug')->ignore($page?->id),
            ],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],

            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],

            'show_in_navigation' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
        ]);
    }

    private function makeUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Page::query()
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
