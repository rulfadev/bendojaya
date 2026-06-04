<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnershipInquiryController extends Controller
{
    public function index(Request $request): View
    {
        $inquiries = PartnershipInquiry::query()
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('partnership_type'), fn ($query) => $query->where('partnership_type', $request->partnership_type))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');

                $query->where(function ($query) use ($search) {
                    $query->where('company_name', 'like', "%{$search}%")
                        ->orWhere('pic_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.partnership-inquiries.index', [
            'title' => 'Inquiry Kerja Sama',
            'subtitle' => 'Kelola calon client kerja sama, custom produksi, brand, dan instansi.',
            'inquiries' => $inquiries,
        ]);
    }

    public function show(PartnershipInquiry $partnershipInquiry): View
    {
        return view('admin.partnership-inquiries.show', [
            'title' => 'Detail Inquiry Kerja Sama',
            'subtitle' => 'Lihat detail kebutuhan calon partner.',
            'inquiry' => $partnershipInquiry,
        ]);
    }

    public function updateStatus(Request $request, PartnershipInquiry $partnershipInquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,contacted,completed,archived'],
            'follow_up_note' => ['nullable', 'string'],
        ]);

        $payload = [
            'status' => $validated['status'],
            'follow_up_note' => $validated['follow_up_note'] ?? null,
        ];

        if ($validated['status'] === 'contacted' && ! $partnershipInquiry->contacted_at) {
            $payload['contacted_at'] = now();
        }

        if ($validated['status'] === 'completed' && ! $partnershipInquiry->completed_at) {
            $payload['completed_at'] = now();
        }

        $partnershipInquiry->update($payload);

        return back()->with('success', 'Status inquiry berhasil diperbarui.');
    }

    public function destroy(PartnershipInquiry $partnershipInquiry): RedirectResponse
    {
        $partnershipInquiry->delete();

        return redirect()
            ->route('admin.partnership-inquiries.index')
            ->with('success', 'Inquiry kerja sama berhasil dihapus.');
    }
}
