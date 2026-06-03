<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::query()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.testimonials.index', [
            'title' => 'Testimoni',
            'subtitle' => 'Kelola testimoni client dan link form feedback.',
            'testimonials' => $testimonials,
        ]);
    }

    public function create(): View
    {
        return view('admin.testimonials.create', [
            'title' => 'Tambah Testimoni',
            'subtitle' => 'Buat testimoni manual atau link form untuk client.',
            'testimonial' => new Testimonial([
                'status' => 'pending',
                'is_featured' => false,
                'consent_to_publish' => true,
                'sort_order' => 0,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['consent_to_publish'] = $request->boolean('consent_to_publish');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if (($validated['status'] ?? 'pending') === 'approved') {
            $validated['approved_at'] = now();
        }

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('testimonials/photos', 'public');
        }

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('testimonials/logos', 'public');
        }

        Testimonial::query()->create($validated);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', [
            'title' => 'Edit Testimoni',
            'subtitle' => 'Perbarui data testimoni client.',
            'testimonial' => $testimonial,
        ]);
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $this->validated($request);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['consent_to_publish'] = $request->boolean('consent_to_publish');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if (($validated['status'] ?? 'pending') === 'approved' && ! $testimonial->approved_at) {
            $validated['approved_at'] = now();
        }

        if (($validated['status'] ?? 'pending') !== 'approved') {
            $validated['approved_at'] = null;
        }

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

        $testimonial->update($validated);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function approve(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update([
            'status' => 'approved',
            'approved_at' => now(),
            'consent_to_publish' => true,
        ]);

        return back()->with('success', 'Testimoni berhasil di-approve.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        if ($testimonial->logo) {
            Storage::disk('public')->delete($testimonial->logo);
        }

        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate(
            [
                'name' => ['nullable', 'string', 'max:150'],
                'company_name' => ['nullable', 'string', 'max:180'],
                'position' => ['nullable', 'string', 'max:150'],
                'email' => ['nullable', 'email', 'max:180'],
                'phone' => ['nullable', 'string', 'max:40'],
                'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
                'message' => ['nullable', 'string'],
                'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
                'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
                'status' => ['required', Rule::in(array_keys(Testimonial::STATUSES))],
                'is_featured' => ['nullable', 'boolean'],
                'consent_to_publish' => ['nullable', 'boolean'],
                'sort_order' => ['nullable', 'integer', 'min:0'],
            ],
            [
                'email.email' => 'Format email tidak valid.',
                'rating.min' => 'Rating minimal 1.',
                'rating.max' => 'Rating maksimal 5.',
                'photo.image' => 'Foto harus berupa gambar.',
                'logo.image' => 'Logo harus berupa gambar.',
            ]
        );
    }
}
