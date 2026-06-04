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

        CollectionInquiry::query()->create([
            ...$validated,
            'collection_id' => $collection->id,
            'status' => 'new',
            'source_url' => url()->previous(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Inquiry koleksi berhasil dikirim. Tim Bendo Jaya akan menghubungi Anda.');
    }
}
