<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::query()
            ->when(request('status'), fn ($query, $status) => $query->status($status))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.contact-messages.index', [
            'title' => 'Pesan Kontak',
            'subtitle' => 'Kelola pesan masuk dan status follow up pengunjung website.',
            'messages' => $messages,
        ]);
    }

    public function show(ContactMessage $contactMessage): View
    {
        $contactMessage->markAsRead();

        return view('admin.contact-messages.show', [
            'title' => 'Detail Pesan',
            'subtitle' => 'Lihat detail pesan dari pengunjung website.',
            'message' => $contactMessage,
        ]);
    }

    public function markAsRead(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->markAsRead();

        return back()->with('success', 'Pesan ditandai sudah dibaca.');
    }

    public function destroy(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }

    public function updateStatus(ContactMessage $contactMessage): RedirectResponse
    {
        $validated = request()->validate([
            'status' => ['required', 'in:new,read,contacted,completed,archived'],
            'follow_up_note' => ['nullable', 'string'],
        ]);

        $payload = [
            'status' => $validated['status'],
            'follow_up_note' => $validated['follow_up_note'] ?? null,
        ];

        if (in_array($validated['status'], ['read', 'contacted', 'completed', 'archived'], true)) {
            $payload['is_read'] = true;
            $payload['read_at'] = $contactMessage->read_at ?: now();
        }

        if ($validated['status'] === 'new') {
            $payload['is_read'] = false;
            $payload['read_at'] = null;
        }

        if ($validated['status'] === 'contacted' && ! $contactMessage->contacted_at) {
            $payload['contacted_at'] = now();
        }

        if ($validated['status'] === 'completed' && ! $contactMessage->completed_at) {
            $payload['completed_at'] = now();
        }

        $contactMessage->update($payload);

        return back()->with('success', 'Status pesan berhasil diperbarui.');
    }
}
