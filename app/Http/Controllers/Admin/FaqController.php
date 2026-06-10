<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\SavesInlineEnglishTranslation;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    use SavesInlineEnglishTranslation;

    public function index(): View
    {
        $faqs = Faq::query()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(12);

        return view('admin.faqs.index', [
            'title' => 'FAQ',
            'subtitle' => 'Kelola pertanyaan yang sering diajukan.',
            'faqs' => $faqs,
        ]);
    }

    public function create(): View
    {
        return view('admin.faqs.create', [
            'title' => 'Tambah FAQ',
            'subtitle' => 'Tambahkan pertanyaan baru.',
            'faq' => new Faq([
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 0,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        $faq = Faq::query()->create($validated);

        $this->saveInlineEnglishTranslation($faq, $request, [
            'question',
            'answer',
            'category',
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', [
            'title' => 'Edit FAQ',
            'subtitle' => 'Perbarui pertanyaan FAQ.',
            'faq' => $faq,
        ]);
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $this->validated($request);

        $faq->update($validated);

        $this->saveInlineEnglishTranslation($faq, $request, [
            'question',
            'answer',
            'category',
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate(
            [
                'question' => ['required', 'string', 'max:255'],
                'answer' => ['nullable', 'string'],
                'category' => ['nullable', 'string', 'max:120'],
                'sort_order' => ['nullable', 'integer', 'min:0'],
                'is_featured' => ['nullable', 'boolean'],
                'is_active' => ['nullable', 'boolean'],
            ],
            [
                'question.required' => 'Pertanyaan wajib diisi.',
                'question.max' => 'Pertanyaan maksimal 255 karakter.',
            ]
        );

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }
}
