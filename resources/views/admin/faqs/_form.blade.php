@php
    $inputClass =
        'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-200';
    $labelClass = 'mb-2 block text-sm font-black text-stone-800';
    $cardClass = 'rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm';
@endphp

<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="{{ $cardClass }}">
            <div class="grid gap-5">
                <div>
                    <label class="{{ $labelClass }}">Pertanyaan</label>
                    <input type="text" name="question" value="{{ old('question', $faq->question) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Jawaban</label>
                    <textarea name="answer" rows="9" class="{{ $inputClass }}">{{ old('answer', $faq->answer) }}</textarea>
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <div>
                <label class="{{ $labelClass }}">Kategori</label>
                <input type="text" name="category" value="{{ old('category', $faq->category) }}"
                    class="{{ $inputClass }}" placeholder="Custom / Kerja Sama / Pemesanan">
            </div>

            <div class="mt-5">
                <label class="{{ $labelClass }}">Urutan</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order) }}"
                    class="{{ $inputClass }}" min="0">
            </div>

            <label
                class="mt-5 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Aktif</span>
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $faq->is_active ?? true))>
            </label>

            <label
                class="mt-4 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Tampil di Homepage</span>
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $faq->is_featured ?? true))>
            </label>
        </section>

        <button type="submit" class="w-full rounded-2xl bg-stone-950 px-5 py-3.5 text-sm font-black text-amber-200">
            Simpan FAQ
        </button>
    </div>
</div>
