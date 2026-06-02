<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:150'],
                'email' => ['nullable', 'email', 'max:180'],
                'phone' => ['nullable', 'string', 'max:40'],
                'subject' => ['nullable', 'string', 'max:180'],
                'message' => ['required', 'string', 'max:5000'],

                // honeypot
                'website' => ['nullable', 'max:0'],
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'message.required' => 'Pesan wajib diisi.',
                'message.max' => 'Pesan maksimal 5000 karakter.',
                'website.max' => 'Pesan tidak dapat diproses.',
            ]
        );

        unset($validated['website']);

        ContactMessage::query()->create([
            ...$validated,
            'source_url' => url()->previous(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Pesan berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
