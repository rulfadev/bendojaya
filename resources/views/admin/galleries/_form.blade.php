@php
    $inputClass =
        'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-200';
    $labelClass = 'mb-2 block text-sm font-black text-stone-800';
    $cardClass = 'rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm';
@endphp

<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="{{ $cardClass }}">
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $gallery->slug) }}"
                        class="{{ $inputClass }}" placeholder="Kosongkan untuk otomatis">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $gallery->category) }}"
                        class="{{ $inputClass }}" placeholder="Product Shoot">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}"
                        class="{{ $inputClass }}" min="0">
                </div>

                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Caption</label>
                    <textarea name="caption" rows="4" class="{{ $inputClass }}">{{ old('caption', $gallery->caption) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Deskripsi</label>
                    <textarea name="description" rows="7" class="{{ $inputClass }}">{{ old('description', $gallery->description) }}</textarea>
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Gambar</p>

            @if ($gallery->image)
                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                    class="mt-5 h-72 w-full rounded-2xl object-cover">
            @endif

            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
                class="mt-5 block w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm">
        </section>

        <section class="{{ $cardClass }}">
            <label class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Aktif</span>
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $gallery->is_active))>
            </label>

            <label
                class="mt-4 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Tampil di Homepage</span>
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $gallery->is_featured))>
            </label>
        </section>

        <button type="submit" class="w-full rounded-2xl bg-stone-950 px-5 py-3.5 text-sm font-black text-amber-200">
            Simpan
        </button>
    </div>
</div>
