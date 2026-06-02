@php
    $inputClass =
        'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition placeholder:text-stone-400 focus:border-stone-950 focus:ring-4 focus:ring-amber-200';
    $labelClass = 'mb-2 block text-sm font-black text-stone-800';
    $cardClass = 'rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm';
@endphp

<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="{{ $cardClass }}">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Konten Layanan</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Informasi Utama</h3>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="title" class="{{ $labelClass }}">Judul Layanan</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}"
                        class="{{ $inputClass }}" placeholder="Contoh: Custom Seragam Batik">
                </div>

                <div>
                    <label for="slug" class="{{ $labelClass }}">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $service->slug) }}"
                        class="{{ $inputClass }}" placeholder="Kosongkan untuk otomatis">
                    <p class="mt-2 text-xs font-semibold text-stone-500">Slug boleh dikosongkan, nanti otomatis dibuat
                        dari judul.</p>
                </div>

                <div>
                    <label for="icon" class="{{ $labelClass }}">Icon / Label Kecil</label>
                    <input type="text" id="icon" name="icon" value="{{ old('icon', $service->icon) }}"
                        class="{{ $inputClass }}" placeholder="01 / ✦ / icon class">
                </div>

                <div>
                    <label for="sort_order" class="{{ $labelClass }}">Urutan</label>
                    <input type="number" id="sort_order" name="sort_order"
                        value="{{ old('sort_order', $service->sort_order) }}" class="{{ $inputClass }}"
                        min="0">
                </div>

                <div class="md:col-span-2">
                    <label for="short_description" class="{{ $labelClass }}">Deskripsi Singkat</label>
                    <textarea id="short_description" name="short_description" rows="4" class="{{ $inputClass }}"
                        placeholder="Deskripsi pendek yang tampil di homepage">{{ old('short_description', $service->short_description) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="{{ $labelClass }}">Deskripsi Lengkap</label>
                    <textarea id="description" name="description" rows="7" class="{{ $inputClass }}"
                        placeholder="Deskripsi lengkap untuk halaman detail layanan nanti">{{ old('description', $service->description) }}</textarea>
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Gambar</p>
            <h3 class="mt-2 text-xl font-black text-stone-950">Visual Layanan</h3>

            @if ($service->image)
                <div class="mt-6 overflow-hidden rounded-3xl border border-stone-200 bg-white p-3">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                        class="h-48 w-full rounded-2xl object-cover">
                </div>
            @endif

            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,.svg"
                class="mt-5 block w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-600 file:mr-4 file:rounded-xl file:border-0 file:bg-stone-950 file:px-4 file:py-2 file:text-sm file:font-black file:text-amber-200">
        </section>

        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Status</p>
            <h3 class="mt-2 text-xl font-black text-stone-950">Pengaturan Tampil</h3>

            <div class="mt-6 space-y-4">
                <label class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                    <span class="text-sm font-black text-stone-800">Aktif</span>
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $service->is_active))
                        class="rounded border-stone-300 text-stone-950 focus:ring-amber-300">
                </label>

                <label class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                    <span class="text-sm font-black text-stone-800">Tampil di Homepage</span>
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $service->is_featured))
                        class="rounded border-stone-300 text-stone-950 focus:ring-amber-300">
                </label>
                <label class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                    <span class="text-sm font-black text-stone-800">Tampilkan Tombol</span>
                    <input type="checkbox" name="show_button" value="1" @checked(old('show_button', $service->show_button ?? true))>
                </label>

                <div class="mt-4">
                    <label for="button_label" class="{{ $labelClass }}">Label Tombol</label>
                    <input type="text" id="button_label" name="button_label"
                        value="{{ old('button_label', $service->button_label) }}" class="{{ $inputClass }}"
                        placeholder="Konsultasi">
                </div>

                <div class="mt-4">
                    <label for="button_url" class="{{ $labelClass }}">URL Tombol</label>
                    <input type="text" id="button_url" name="button_url"
                        value="{{ old('button_url', $service->button_url) }}" class="{{ $inputClass }}"
                        placeholder="/pages/kerja-sama atau https://wa.me/628...">
                </div>
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 shadow-xl shadow-stone-900/10">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-300">Simpan</p>
            <h3 class="mt-2 text-xl font-black text-white">Simpan Layanan</h3>
            <p class="mt-3 text-sm leading-6 text-stone-300">
                Data layanan akan digunakan untuk section layanan di website.
            </p>

            <button type="submit"
                class="mt-6 w-full rounded-2xl bg-amber-300 px-5 py-3.5 text-sm font-black text-stone-950 transition hover:bg-amber-200">
                Simpan
            </button>

            <a href="{{ route('admin.services.index') }}"
                class="mt-3 inline-flex w-full justify-center rounded-2xl border border-white/10 px-5 py-3 text-sm font-black text-stone-200 transition hover:bg-white/10">
                Kembali
            </a>
        </section>
    </div>
</div>
