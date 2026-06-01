<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PageSectionController extends Controller
{
    public function index(Page $page): View
    {
        $sections = $page->sections()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(10);

        return view('admin.page-sections.index', [
            'title' => 'Section Halaman',
            'subtitle' => 'Kelola susunan section untuk halaman: '.$page->title,
            'page' => $page,
            'sections' => $sections,
        ]);
    }

    public function create(Page $page): View
    {
        return view('admin.page-sections.create', [
            'title' => 'Tambah Section',
            'subtitle' => 'Tambahkan section baru untuk halaman: '.$page->title,
            'page' => $page,
            'section' => new PageSection([
                'type' => 'text',
                'image_position' => 'right',
                'is_active' => true,
                'sort_order' => 0,
            ]),
            'types' => PageSection::TYPES,
        ]);
    }

    public function store(Request $request, Page $page): RedirectResponse
    {
        $validated = $this->validateSection($request);

        $validated['page_id'] = $page->id;
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['settings'] = $this->parseSettings($request->input('settings_text'));

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('page-sections', 'public');
        }

        PageSection::query()->create($validated);

        return redirect()
            ->route('admin.pages.sections.index', $page)
            ->with('success', 'Section halaman berhasil ditambahkan.');
    }

    public function edit(Page $page, PageSection $section): View
    {
        $this->ensureSectionBelongsToPage($page, $section);

        return view('admin.page-sections.edit', [
            'title' => 'Edit Section',
            'subtitle' => 'Perbarui section halaman: '.$page->title,
            'page' => $page,
            'section' => $section,
            'types' => PageSection::TYPES,
        ]);
    }

    public function update(Request $request, Page $page, PageSection $section): RedirectResponse
    {
        $this->ensureSectionBelongsToPage($page, $section);

        $validated = $this->validateSection($request);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['settings'] = $this->parseSettings($request->input('settings_text'));

        if ($request->hasFile('image')) {
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }

            $validated['image'] = $request->file('image')->store('page-sections', 'public');
        }

        $section->update($validated);

        return redirect()
            ->route('admin.pages.sections.index', $page)
            ->with('success', 'Section halaman berhasil diperbarui.');
    }

    public function destroy(Page $page, PageSection $section): RedirectResponse
    {
        $this->ensureSectionBelongsToPage($page, $section);

        if ($section->image) {
            Storage::disk('public')->delete($section->image);
        }

        $section->delete();

        return redirect()
            ->route('admin.pages.sections.index', $page)
            ->with('success', 'Section halaman berhasil dihapus.');
    }

    private function validateSection(Request $request): array
    {
        return $request->validate(
            [
                'type' => ['required', 'string', Rule::in(array_keys(PageSection::TYPES))],
                'eyebrow' => ['nullable', 'string', 'max:150'],
                'title' => ['nullable', 'string', 'max:220'],
                'subtitle' => ['nullable', 'string'],
                'content' => ['nullable', 'string'],

                'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
                'image_position' => ['nullable', 'string', Rule::in(['left', 'right'])],

                'button_label' => ['nullable', 'string', 'max:120'],
                'button_url' => ['nullable', 'string', 'max:255'],

                'settings_text' => ['nullable', 'string'],

                'is_active' => ['nullable', 'boolean'],
                'sort_order' => ['nullable', 'integer', 'min:0'],
            ],
            [
                'type.required' => 'Tipe section wajib dipilih.',
                'type.in' => 'Tipe section tidak valid.',

                'title.max' => 'Judul section maksimal 220 karakter.',
                'eyebrow.max' => 'Label kecil maksimal 150 karakter.',

                'image.uploaded' => 'Gambar gagal diupload. Pastikan ukuran file tidak terlalu besar.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
                'image.max' => 'Ukuran gambar maksimal 4MB.',

                'image_position.in' => 'Posisi gambar tidak valid.',

                'button_label.max' => 'Label tombol maksimal 120 karakter.',
                'button_url.max' => 'URL tombol maksimal 255 karakter.',

                'sort_order.integer' => 'Urutan harus berupa angka.',
                'sort_order.min' => 'Urutan minimal 0.',
            ]
        );
    }

    private function parseSettings(?string $settingsText): ?array
    {
        if (! $settingsText) {
            return null;
        }

        $decoded = json_decode($settingsText, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        return is_array($decoded) ? $decoded : null;
    }

    private function ensureSectionBelongsToPage(Page $page, PageSection $section): void
    {
        abort_unless($section->page_id === $page->id, 404);
    }
}
