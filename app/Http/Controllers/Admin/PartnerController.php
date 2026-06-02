<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        $partners = Partner::query()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.partners.index', [
            'title' => 'Partner',
            'subtitle' => 'Kelola brand, komunitas, instansi, dan kerja sama Bendo Jaya.',
            'partners' => $partners,
        ]);
    }

    public function create(): View
    {
        return view('admin.partners.create', [
            'title' => 'Tambah Partner',
            'subtitle' => 'Tambahkan partner atau brand kerja sama.',
            'partner' => new Partner([
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 0,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePartner($request);

        $validated['slug'] = $this->makeUniqueSlug($validated['slug'] ?? $validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('partners', 'public');
        }

        Partner::query()->create($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    public function edit(Partner $partner): View
    {
        return view('admin.partners.edit', [
            'title' => 'Edit Partner',
            'subtitle' => 'Perbarui informasi partner.',
            'partner' => $partner,
        ]);
    }

    public function update(Request $request, Partner $partner): RedirectResponse
    {
        $validated = $this->validatePartner($request, $partner);

        $validated['slug'] = $this->makeUniqueSlug($validated['slug'] ?? $validated['name'], $partner->id);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('logo')) {
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }

            $validated['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diperbarui.');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus.');
    }

    private function validatePartner(Request $request, ?Partner $partner = null): array
    {
        return $request->validate(
            [
                'name' => ['required', 'string', 'max:180'],
                'slug' => [
                    'nullable',
                    'string',
                    'max:220',
                    Rule::unique('partners', 'slug')->ignore($partner?->id),
                ],
                'category' => ['nullable', 'string', 'max:150'],
                'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
                'description' => ['nullable', 'string'],
                'website_url' => ['nullable', 'url', 'max:255'],
                'instagram_url' => ['nullable', 'url', 'max:255'],
                'whatsapp_number' => ['nullable', 'string', 'max:30'],
                'sort_order' => ['nullable', 'integer', 'min:0'],
                'is_featured' => ['nullable', 'boolean'],
                'is_active' => ['nullable', 'boolean'],
            ],
            [
                'name.required' => 'Nama partner wajib diisi.',
                'slug.unique' => 'Slug partner sudah digunakan.',
                'logo.image' => 'Logo harus berupa gambar.',
                'logo.mimes' => 'Format logo harus jpg, jpeg, png, webp, atau svg.',
                'logo.max' => 'Ukuran logo maksimal 4MB.',
                'website_url.url' => 'URL website tidak valid.',
                'instagram_url.url' => 'URL Instagram tidak valid.',
            ]
        );
    }

    private function makeUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Partner::query()
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
