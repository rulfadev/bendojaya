<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(Request $request): View
    {
        $logs = ActivityLog::query()
            ->with('user')
            ->when($request->filled('action'), fn ($query) => $query->where('action', $request->action))
            ->when($request->filled('user_id'), fn ($query) => $query->where('user_id', $request->user_id))
            ->when($request->filled('subject_type'), fn ($query) => $query->where('subject_type', $request->subject_type))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');

                $query->where(function ($query) use ($search) {
                    $query->where('description', 'like', "%{$search}%")
                        ->orWhere('url', 'like', "%{$search}%")
                        ->orWhere('ip_address', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $users = User::query()
            ->orderBy('name')
            ->get(['id', 'name', 'email']);

        $subjects = ActivityLog::query()
            ->whereNotNull('subject_type')
            ->distinct()
            ->orderBy('subject_type')
            ->pluck('subject_type');

        return view('admin.activity-logs.index', [
            'title' => 'Activity Log',
            'subtitle' => 'Pantau aktivitas admin, editor, dan staff.',
            'logs' => $logs,
            'users' => $users,
            'subjects' => $subjects,
        ]);
    }

    public function show(ActivityLog $activityLog): View
    {
        $activityLog->load('user');

        return view('admin.activity-logs.show', [
            'title' => 'Detail Activity Log',
            'subtitle' => 'Lihat detail perubahan data.',
            'log' => $activityLog,
        ]);
    }

    public function destroy(ActivityLog $activityLog): RedirectResponse
    {
        $activityLog->delete();

        return redirect()
            ->route('admin.activity-logs.index')
            ->with('success', 'Activity log berhasil dihapus.');
    }

    public function clearOld(): RedirectResponse
    {
        $total = ActivityLog::query()
            ->where('created_at', '<', now()->subDays(90))
            ->delete();

        return back()->with('success', "{$total} activity log lama berhasil dihapus.");
    }
}
