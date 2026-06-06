<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(Request $request): View
    {
        $notifications = AdminNotification::query()
            ->when($request->filled('status'), function ($query) use ($request) {
                if ($request->status === 'unread') {
                    $query->whereNull('read_at');
                }

                if ($request->status === 'read') {
                    $query->whereNotNull('read_at');
                }
            })
            ->when($request->filled('type'), fn ($query) => $query->where('type', $request->type))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $types = AdminNotification::query()
            ->select('type')
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        return view('admin.notifications.index', [
            'title' => 'Notifikasi',
            'subtitle' => 'Pantau inquiry, quotation, dan aktivitas penting client.',
            'notifications' => $notifications,
            'types' => $types,
        ]);
    }

    public function read(AdminNotification $notification): RedirectResponse
    {
        if (! $notification->read_at) {
            $notification->update([
                'read_at' => now(),
            ]);
        }

        if ($notification->url) {
            return redirect($notification->url);
        }

        return back();
    }

    public function markAsRead(AdminNotification $notification): RedirectResponse
    {
        $notification->update([
            'read_at' => now(),
        ]);

        return back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }

    public function markAllAsRead(): RedirectResponse
    {
        AdminNotification::query()
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }

    public function destroy(AdminNotification $notification): RedirectResponse
    {
        $notification->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }
}
