<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::query()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.galleries.index', [
            'title' => 'Gallery',
            'subtitle' => 'Kelola dokumentasi karya, produk, dan proses Bendo Jaya.',
            'galleries' => $galleries,
        ]);
    }

    public function create(): View
    {
        return view('admin.galleries.create', [
            'title' => 'Tambah Gallery',
            'subtitle' => 'Tambahkan foto baru ke gallery website.',
            'gallery' => new Gallery([
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 0,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateGallery($request);

        $validated['slug'] = $this->makeUniqueSlug($validated['slug'] ?? $validated['title']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        Gallery::query()->create($validated);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.galleries.edit', [
            'title' => 'Edit Gallery',
            'subtitle' => 'Perbarui data gallery.',
            'gallery' => $gallery,
        ]);
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $validated = $this->validateGallery($request, $gallery);

        $validated['slug'] = $this->makeUniqueSlug($validated['slug'] ?? $validated['title'], $gallery->id);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }

            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery berhasil dihapus.');
    }

    private function validateGallery(Request $request, ?Gallery $gallery = null): array
    {
        return $request->validate(
            [
                'title' => ['required', 'string', 'max:180'],
                'slug' => [
                    'nullable',
                    'string',
                    'max:220',
                    Rule::unique('galleries', 'slug')->ignore($gallery?->id),
                ],
                'category' => ['nullable', 'string', 'max:150'],
                'image' => [$gallery ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
                'caption' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'sort_order' => ['nullable', 'integer', 'min:0'],
                'is_featured' => ['nullable', 'boolean'],
                'is_active' => ['nullable', 'boolean'],
            ],
            [
                'title.required' => 'Judul gallery wajib diisi.',
                'slug.unique' => 'Slug gallery sudah digunakan.',
                'image.required' => 'Gambar gallery wajib diupload.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
                'image.max' => 'Ukuran gambar maksimal 4MB.',
            ]
        );
    }

    private function makeUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Gallery::query()
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
