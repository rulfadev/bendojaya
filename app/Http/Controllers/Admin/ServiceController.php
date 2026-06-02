<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::query()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.services.index', [
            'title' => 'Layanan',
            'subtitle' => 'Kelola layanan yang tampil di website Bendo Jaya.',
            'services' => $services,
        ]);
    }

    public function create(): View
    {
        return view('admin.services.create', [
            'title' => 'Tambah Layanan',
            'subtitle' => 'Buat layanan baru untuk ditampilkan di website.',
            'service' => new Service([
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 0,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateService($request);

        $validated['slug'] = $this->makeUniqueSlug(
            $validated['slug'] ?? $validated['title']
        );

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['show_button'] = $request->boolean('show_button');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        Service::query()->create($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', [
            'title' => 'Edit Layanan',
            'subtitle' => 'Perbarui informasi layanan website.',
            'service' => $service,
        ]);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $this->validateService($request, $service);

        $validated['slug'] = $this->makeUniqueSlug(
            $validated['slug'] ?? $validated['title'],
            $service->id
        );

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['show_button'] = $request->boolean('show_button');

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }

    private function validateService(Request $request, ?Service $service = null): array
    {
        return $request->validate(
            [
                'title' => ['required', 'string', 'max:180'],
                'slug' => [
                    'nullable',
                    'string',
                    'max:200',
                    Rule::unique('services', 'slug')->ignore($service?->id),
                ],
                'icon' => ['nullable', 'string', 'max:80'],
                'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
                'short_description' => ['required', 'string'],
                'description' => ['nullable', 'string'],
                'sort_order' => ['nullable', 'integer', 'min:0'],
                'is_featured' => ['nullable', 'boolean'],
                'is_active' => ['nullable', 'boolean'],
                'show_button' => ['nullable', 'boolean'],
                'button_label' => ['nullable', 'string', 'max:120'],
                'button_url' => ['nullable', 'string', 'max:255'],
            ],
            [
                'title.required' => 'Judul layanan wajib diisi.',
                'title.max' => 'Judul layanan maksimal 180 karakter.',

                'slug.unique' => 'Slug layanan sudah digunakan.',
                'slug.max' => 'Slug layanan maksimal 200 karakter.',

                'image.uploaded' => 'Gambar gagal diupload. Pastikan ukuran file tidak terlalu besar.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
                'image.max' => 'Ukuran gambar maksimal 4MB.',

                'short_description.required' => 'Deskripsi singkat wajib diisi.',

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
            Service::query()
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
