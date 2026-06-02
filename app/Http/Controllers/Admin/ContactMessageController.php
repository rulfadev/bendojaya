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
            ->latest()
            ->paginate(12);

        return view('admin.contact-messages.index', [
            'title' => 'Pesan Kontak',
            'subtitle' => 'Kelola pesan masuk dari pengunjung website.',
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
}
