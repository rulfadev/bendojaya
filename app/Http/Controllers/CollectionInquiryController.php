<?php

namespace App\Http\Controllers;

use App\Models\CollectionInquiry;
use App\Models\FashionCollection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CollectionInquiryController extends Controller
{
    public function store(Request $request, FashionCollection $collection): RedirectResponse
    {
        if ($request->filled('website')) {
            return back();
        }

        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:150'],
                'email' => ['nullable', 'email', 'max:150'],
                'phone' => ['required', 'string', 'max:30'],
                'size' => ['nullable', 'string', 'max:80'],
                'quantity' => ['nullable', 'integer', 'min:1'],
                'need_type' => ['nullable', 'string', 'max:80'],
                'message' => ['nullable', 'string', 'max:2000'],
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'phone.required' => 'Nomor WhatsApp wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'quantity.integer' => 'Jumlah harus berupa angka.',
                'quantity.min' => 'Jumlah minimal 1.',
            ]
        );

        $inquiry = CollectionInquiry::query()->create([
            ...$validated,
            'collection_id' => $collection->id,
            'status' => 'new',
            'source_url' => url()->previous(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $setting = SiteSetting::query()->first();

        $adminWhatsapp = preg_replace('/[^0-9]/', '', $setting?->whatsapp_number ?? '6280000000000');

        if (str_starts_with($adminWhatsapp, '0')) {
            $adminWhatsapp = '62'.substr($adminWhatsapp, 1);
        }

        $message = "Halo admin Bendo Jaya, saya sudah mengajukan inquiry koleksi.\n\n";
        $message .= "Kode Inquiry: #{$inquiry->id}\n";
        $message .= "Nama: {$inquiry->name}\n";
        $message .= "WhatsApp: {$inquiry->phone}\n";
        $message .= "Koleksi: {$collection->name}\n";
        $message .= 'Kategori: '.($collection->category ?: '-')."\n";
        $message .= "Kebutuhan: {$inquiry->need_type_label}\n";
        $message .= 'Ukuran: '.($inquiry->size ?: '-')."\n";
        $message .= 'Jumlah: '.($inquiry->quantity ?: '-')."\n\n";

        if ($inquiry->message) {
            $message .= "Catatan:\n{$inquiry->message}\n\n";
        }

        $message .= 'Mohon dibantu konsultasinya.';

        $whatsappUrl = 'https://wa.me/'.$adminWhatsapp.'?text='.rawurlencode($message);

        return redirect()->away($whatsappUrl);
    }
}
