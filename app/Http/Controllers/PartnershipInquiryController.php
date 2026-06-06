<?php

namespace App\Http\Controllers;

use App\Models\PartnershipInquiry;
use App\Models\SiteSetting;
use App\Support\AdminNotifier;
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

        $inquiry = PartnershipInquiry::query()->create([
            ...$validated,
            'status' => 'new',
            'source_url' => url()->previous(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        AdminNotifier::send(
            'partnership_inquiry',
            'Inquiry kerja sama baru',
            ($inquiry->company_name ?: 'Kerja Sama Bendo Jaya').' dari PIC '.$inquiry->pic_name,
            route('admin.partnership-inquiries.show', $inquiry),
            [
                'id' => $inquiry->id,
                'phone' => $inquiry->phone,
            ]
        );

        $setting = SiteSetting::query()->first();

        $adminWhatsapp = preg_replace('/[^0-9]/', '', $setting?->whatsapp_number ?? '6280000000000');

        if (str_starts_with($adminWhatsapp, '0')) {
            $adminWhatsapp = '62'.substr($adminWhatsapp, 1);
        }

        $message = "Halo admin Bendo Jaya, saya sudah mengajukan inquiry kerja sama.\n\n";
        $message .= "Kode Inquiry: #{$inquiry->id}\n";
        $message .= 'Brand/Perusahaan: '.($inquiry->company_name ?: '-')."\n";
        $message .= "PIC: {$inquiry->pic_name}\n";
        $message .= "WhatsApp: {$inquiry->phone}\n";
        $message .= "Jenis Kerja Sama: {$inquiry->partnership_type_label}\n";
        $message .= 'Estimasi Jumlah: '.($inquiry->estimated_quantity ?: '-')."\n";
        $message .= 'Budget: '.($inquiry->budget_range ?: '-')."\n";
        $message .= 'Deadline: '.($inquiry->deadline_date?->format('d M Y') ?: '-')."\n\n";

        if ($inquiry->message) {
            $message .= "Catatan:\n{$inquiry->message}\n\n";
        }

        $message .= 'Mohon dibantu konsultasinya.';

        $whatsappUrl = 'https://wa.me/'.$adminWhatsapp.'?text='.rawurlencode($message);

        return redirect()->away($whatsappUrl);
    }
}
