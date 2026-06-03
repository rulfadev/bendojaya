<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TestimonialFormController extends Controller
{
    public function show(Testimonial $testimonial): View
    {
        $setting = SiteSetting::query()->first();

        return view('testimonials.form', [
            'setting' => $setting,
            'testimonial' => $testimonial,
            'title' => 'Form Testimoni Client - Bendo Jaya',
            'metaDescription' => 'Form testimoni client Bendo Jaya Batik Fashion.',
        ]);
    }

    public function submit(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:150'],
                'company_name' => ['nullable', 'string', 'max:180'],
                'position' => ['nullable', 'string', 'max:150'],
                'email' => ['nullable', 'email', 'max:180'],
                'phone' => ['nullable', 'string', 'max:40'],
                'rating' => ['required', 'integer', 'min:1', 'max:5'],
                'message' => ['required', 'string', 'max:5000'],
                'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
                'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
                'consent_to_publish' => ['accepted'],
                'website' => ['nullable', 'max:0'],
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'rating.required' => 'Rating wajib dipilih.',
                'message.required' => 'Testimoni wajib diisi.',
                'consent_to_publish.accepted' => 'Izin publikasi wajib dicentang.',
                'website.max' => 'Form tidak dapat diproses.',
            ]
        );

        unset($validated['website']);

        if ($request->hasFile('photo')) {
            if ($testimonial->photo) {
                Storage::disk('public')->delete($testimonial->photo);
            }

            $validated['photo'] = $request->file('photo')->store('testimonials/photos', 'public');
        }

        if ($request->hasFile('logo')) {
            if ($testimonial->logo) {
                Storage::disk('public')->delete($testimonial->logo);
            }

            $validated['logo'] = $request->file('logo')->store('testimonials/logos', 'public');
        }

        $testimonial->update([
            ...$validated,
            'status' => 'pending',
            'is_featured' => false,
            'consent_to_publish' => true,
            'submitted_at' => now(),
        ]);

        return redirect()
            ->route('testimonial-form.thank-you', $testimonial)
            ->with('success', 'Terima kasih, testimoni Anda berhasil dikirim.');
    }

    public function thankYou(Testimonial $testimonial): View
    {
        $setting = SiteSetting::query()->first();

        return view('testimonials.thank-you', [
            'setting' => $setting,
            'testimonial' => $testimonial,
            'title' => 'Terima Kasih - Bendo Jaya',
            'metaDescription' => 'Terima kasih sudah mengirim testimoni untuk Bendo Jaya.',
        ]);
    }
}
