<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaAsset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MediaAssetController extends Controller
{
    public function index(Request $request): View
    {
        $assets = MediaAsset::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');

                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('alt_text', 'like', "%{$search}%")
                        ->orWhere('original_name', 'like', "%{$search}%")
                        ->orWhere('folder', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('folder'), fn ($query) => $query->where('folder', $request->folder))
            ->latest()
            ->paginate(18)
            ->withQueryString();

        $folders = MediaAsset::query()
            ->whereNotNull('folder')
            ->distinct()
            ->orderBy('folder')
            ->pluck('folder');

        return view('admin.media-assets.index', [
            'title' => 'Media Library',
            'subtitle' => 'Kelola file gambar untuk kebutuhan website.',
            'assets' => $assets,
            'folders' => $folders,
        ]);
    }

    public function create(): View
    {
        return view('admin.media-assets.create', [
            'title' => 'Upload Media',
            'subtitle' => 'Tambahkan gambar ke media library.',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'files' => ['required', 'array'],
                'files.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
                'folder' => ['nullable', 'string', 'max:120'],
                'alt_text' => ['nullable', 'string', 'max:180'],
            ],
            [
                'files.required' => 'Pilih minimal satu file.',
                'files.*.image' => 'File harus berupa gambar.',
                'files.*.mimes' => 'Format file harus jpg, jpeg, png, webp, atau svg.',
                'files.*.max' => 'Ukuran file maksimal 4MB.',
            ]
        );

        $folder = $validated['folder']
            ? Str::slug($validated['folder'])
            : 'general';

        foreach ($request->file('files', []) as $file) {
            $path = $file->store('media/'.$folder, 'public');

            MediaAsset::query()->create([
                'user_id' => $request->user()?->id,
                'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'alt_text' => $validated['alt_text'] ?? null,
                'folder' => $folder,
                'disk' => 'public',
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => Storage::disk('public')->size($path),
            ]);
        }

        return redirect()
            ->route('admin.media-assets.index')
            ->with('success', 'Media berhasil diupload.');
    }

    public function edit(MediaAsset $mediaAsset): View
    {
        return view('admin.media-assets.edit', [
            'title' => 'Edit Media',
            'subtitle' => 'Perbarui informasi media.',
            'asset' => $mediaAsset,
        ]);
    }

    public function update(Request $request, MediaAsset $mediaAsset): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:180'],
            'alt_text' => ['nullable', 'string', 'max:180'],
            'folder' => ['nullable', 'string', 'max:120'],
        ]);

        if (! empty($validated['folder'])) {
            $validated['folder'] = Str::slug($validated['folder']);
        }

        $mediaAsset->update($validated);

        return redirect()
            ->route('admin.media-assets.index')
            ->with('success', 'Media berhasil diperbarui.');
    }

    public function destroy(MediaAsset $mediaAsset): RedirectResponse
    {
        Storage::disk($mediaAsset->disk)->delete($mediaAsset->path);

        $mediaAsset->delete();

        return redirect()
            ->route('admin.media-assets.index')
            ->with('success', 'Media berhasil dihapus.');
    }
}
