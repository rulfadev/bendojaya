<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FashionCollection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FashionCollectionController extends Controller
{
    public function index(): View
    {
        $collections = FashionCollection::query()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.collections.index', [
            'title' => 'Koleksi',
            'subtitle' => 'Kelola katalog koleksi batik yang tampil di website.',
            'collections' => $collections,
        ]);
    }

    public function create(): View
    {
        return view('admin.collections.create', [
            'title' => 'Tambah Koleksi',
            'subtitle' => 'Tambahkan koleksi batik baru.',
            'collection' => new FashionCollection([
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 0,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCollection($request);

        $validated['slug'] = $this->makeUniqueSlug(
            $validated['slug'] ?? $validated['name']
        );

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('collections', 'public');
        }

        FashionCollection::query()->create($validated);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Koleksi berhasil ditambahkan.');
    }

    public function edit(FashionCollection $collection): View
    {
        return view('admin.collections.edit', [
            'title' => 'Edit Koleksi',
            'subtitle' => 'Perbarui informasi koleksi batik.',
            'collection' => $collection,
        ]);
    }

    public function update(Request $request, FashionCollection $collection): RedirectResponse
    {
        $validated = $this->validateCollection($request, $collection);

        $validated['slug'] = $this->makeUniqueSlug(
            $validated['slug'] ?? $validated['name'],
            $collection->id
        );

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('main_image')) {
            if ($collection->main_image) {
                Storage::disk('public')->delete($collection->main_image);
            }

            $validated['main_image'] = $request->file('main_image')->store('collections', 'public');
        }

        $collection->update($validated);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Koleksi berhasil diperbarui.');
    }

    public function destroy(FashionCollection $collection): RedirectResponse
    {
        if ($collection->main_image) {
            Storage::disk('public')->delete($collection->main_image);
        }

        $collection->delete();

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Koleksi berhasil dihapus.');
    }

    private function validateCollection(Request $request, ?FashionCollection $collection = null): array
    {
        return $request->validate(
            [
                'name' => ['required', 'string', 'max:180'],
                'slug' => [
                    'nullable',
                    'string',
                    'max:220',
                    Rule::unique('fashion_collections', 'slug')->ignore($collection?->id),
                ],
                'category' => ['nullable', 'string', 'max:150'],

                'main_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

                'short_description' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],

                'material' => ['nullable', 'string', 'max:150'],
                'color_palette' => ['nullable', 'string', 'max:150'],
                'size_info' => ['nullable', 'string', 'max:150'],

                'sort_order' => ['nullable', 'integer', 'min:0'],
                'is_featured' => ['nullable', 'boolean'],
                'is_active' => ['nullable', 'boolean'],
            ],
            [
                'name.required' => 'Nama koleksi wajib diisi.',
                'name.max' => 'Nama koleksi maksimal 180 karakter.',

                'slug.unique' => 'Slug koleksi sudah digunakan.',
                'slug.max' => 'Slug koleksi maksimal 220 karakter.',

                'category.max' => 'Kategori maksimal 150 karakter.',

                'main_image.uploaded' => 'Gambar gagal diupload. Pastikan ukuran file tidak terlalu besar.',
                'main_image.image' => 'File harus berupa gambar.',
                'main_image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
                'main_image.max' => 'Ukuran gambar maksimal 4MB.',

                'sort_order.integer' => 'Urutan harus berupa angka.',
                'sort_order.min' => 'Urutan minimal 0.',
            ]
        );
    }

    private function makeUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $counter = 1;

        while (
            FashionCollection::query()
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
