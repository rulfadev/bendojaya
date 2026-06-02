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
                    <label class="{{ $labelClass }}">Nama Partner</label>
                    <input type="text" name="name" value="{{ old('name', $partner->name) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $partner->slug) }}"
                        class="{{ $inputClass }}" placeholder="Kosongkan untuk otomatis">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $partner->category) }}"
                        class="{{ $inputClass }}" placeholder="Brand Fashion">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $partner->sort_order) }}"
                        class="{{ $inputClass }}" min="0">
                </div>

                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Deskripsi</label>
                    <textarea name="description" rows="5" class="{{ $inputClass }}">{{ old('description', $partner->description) }}</textarea>
                </div>

                <div>
                    <label class="{{ $labelClass }}">Website URL</label>
                    <input type="url" name="website_url" value="{{ old('website_url', $partner->website_url) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Instagram URL</label>
                    <input type="url" name="instagram_url"
                        value="{{ old('instagram_url', $partner->instagram_url) }}" class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">WhatsApp</label>
                    <input type="text" name="whatsapp_number"
                        value="{{ old('whatsapp_number', $partner->whatsapp_number) }}" class="{{ $inputClass }}"
                        placeholder="628...">
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Logo</p>

            @if ($partner->logo)
                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                    class="mt-5 h-40 w-full rounded-2xl object-contain bg-white p-4">
            @endif

            <input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp,.svg"
                class="mt-5 block w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm">
        </section>

        <section class="{{ $cardClass }}">
            <label class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Aktif</span>
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $partner->is_active))>
            </label>

            <label
                class="mt-4 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Tampil di Homepage</span>
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $partner->is_featured))>
            </label>
        </section>

        <button type="submit" class="w-full rounded-2xl bg-stone-950 px-5 py-3.5 text-sm font-black text-amber-200">
            Simpan
        </button>
    </div>
</div>
