<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollectionInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CollectionInquiryController extends Controller
{
    public function index(Request $request): View
    {
        $inquiries = CollectionInquiry::query()
            ->with('collection')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');

                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhereHas('collection', fn ($query) => $query->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.collection-inquiries.index', [
            'title' => 'Inquiry Koleksi',
            'subtitle' => 'Kelola calon client yang tertarik dengan koleksi.',
            'inquiries' => $inquiries,
        ]);
    }

    public function show(CollectionInquiry $collectionInquiry): View
    {
        $collectionInquiry->load('collection');

        return view('admin.collection-inquiries.show', [
            'title' => 'Detail Inquiry Koleksi',
            'subtitle' => 'Lihat detail kebutuhan calon client.',
            'inquiry' => $collectionInquiry,
        ]);
    }

    public function updateStatus(Request $request, CollectionInquiry $collectionInquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,contacted,completed,archived'],
            'follow_up_note' => ['nullable', 'string'],
        ]);

        $payload = [
            'status' => $validated['status'],
            'follow_up_note' => $validated['follow_up_note'] ?? null,
        ];

        if ($validated['status'] === 'contacted' && ! $collectionInquiry->contacted_at) {
            $payload['contacted_at'] = now();
        }

        if ($validated['status'] === 'completed' && ! $collectionInquiry->completed_at) {
            $payload['completed_at'] = now();
        }

        $collectionInquiry->update($payload);

        return back()->with('success', 'Status inquiry berhasil diperbarui.');
    }

    public function destroy(CollectionInquiry $collectionInquiry): RedirectResponse
    {
        $collectionInquiry->delete();

        return redirect()
            ->route('admin.collection-inquiries.index')
            ->with('success', 'Inquiry berhasil dihapus.');
    }
}
