<?php

namespace App\Http\Controllers;

use App\Models\PartnershipInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PartnershipInquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if ($request->filled('website')) {
            return back();
        }

        $validated = $request->validate(
            [
                'company_name' => ['nullable', 'string', 'max:150'],
                'pic_name' => ['required', 'string', 'max:150'],
                'email' => ['nullable', 'email', 'max:150'],
                'phone' => ['required', 'string', 'max:30'],
                'partnership_type' => ['nullable', 'string', 'max:80'],
                'estimated_quantity' => ['nullable', 'integer', 'min:1'],
                'budget_range' => ['nullable', 'string', 'max:80'],
                'deadline_date' => ['nullable', 'date'],
                'message' => ['nullable', 'string', 'max:2500'],
            ],
            [
                'pic_name.required' => 'Nama PIC wajib diisi.',
                'phone.required' => 'Nomor WhatsApp wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'estimated_quantity.integer' => 'Estimasi jumlah harus berupa angka.',
                'estimated_quantity.min' => 'Estimasi jumlah minimal 1.',
                'deadline_date.date' => 'Tanggal deadline tidak valid.',
            ]
        );

        PartnershipInquiry::query()->create([
            ...$validated,
            'status' => 'new',
            'source_url' => url()->previous(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Inquiry kerja sama berhasil dikirim. Tim Bendo Jaya akan menghubungi Anda.');
    }
}
