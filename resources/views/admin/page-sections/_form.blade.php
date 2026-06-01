@php
    $inputClass =
        'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition placeholder:text-stone-400 focus:border-stone-950 focus:ring-4 focus:ring-amber-200';
    $labelClass = 'mb-2 block text-sm font-black text-stone-800';
    $cardClass = 'rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm';

    $settingsText = old(
        'settings_text',
        $section->settings ? json_encode($section->settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '',
    );
@endphp

<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="{{ $cardClass }}">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Page Builder</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Konten Section</h3>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="type" class="{{ $labelClass }}">Tipe Section</label>
                    <select id="type" name="type" class="{{ $inputClass }}">
                        @foreach ($types as $value => $label)
                            <option value="{{ $value }}" @selected(old('type', $section->type) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="sort_order" class="{{ $labelClass }}">Urutan</label>
                    <input type="number" id="sort_order" name="sort_order"
                        value="{{ old('sort_order', $section->sort_order) }}" min="0"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label for="eyebrow" class="{{ $labelClass }}">Eyebrow / Label Kecil</label>
                    <input type="text" id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $section->eyebrow) }}"
                        placeholder="Contoh: Kerja Sama" class="{{ $inputClass }}">
                </div>

                <div>
                    <label for="image_position" class="{{ $labelClass }}">Posisi Gambar</label>
                    <select id="image_position" name="image_position" class="{{ $inputClass }}">
                        <option value="right" @selected(old('image_position', $section->image_position) === 'right')>
                            Kanan
                        </option>
                        <option value="left" @selected(old('image_position', $section->image_position) === 'left')>
                            Kiri
                        </option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="title" class="{{ $labelClass }}">Judul</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $section->title) }}"
                        placeholder="Judul section" class="{{ $inputClass }}">
                </div>

                <div class="md:col-span-2">
                    <label for="subtitle" class="{{ $labelClass }}">Subtitle / Deskripsi Pendek</label>
                    <textarea id="subtitle" name="subtitle" rows="4" class="{{ $inputClass }}">{{ old('subtitle', $section->subtitle) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="content" class="{{ $labelClass }}">Konten</label>
                    <textarea id="content" name="content" rows="10" class="{{ $inputClass }}"
                        placeholder="Boleh isi HTML sederhana seperti <p>...</p>">{{ old('content', $section->content) }}</textarea>
                    <p class="mt-2 text-xs font-semibold text-stone-500">
                        Untuk tipe Raw HTML, isi konten ini akan ditampilkan langsung.
                    </p>
                </div>
            </div>
        </section>

        <section class="{{ $cardClass }}">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Button</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Tombol Section</h3>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="button_label" class="{{ $labelClass }}">Label Tombol</label>
                    <input type="text" id="button_label" name="button_label"
                        value="{{ old('button_label', $section->button_label) }}"
                        placeholder="Contoh: Konsultasi Sekarang" class="{{ $inputClass }}">
                </div>

                <div>
                    <label for="button_url" class="{{ $labelClass }}">URL Tombol</label>
                    <input type="text" id="button_url" name="button_url"
                        value="{{ old('button_url', $section->button_url) }}"
                        placeholder="/pages/kerja-sama atau https://wa.me/628..." class="{{ $inputClass }}">
                </div>
            </div>
        </section>

        <section class="{{ $cardClass }}">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Advanced</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Settings JSON</h3>
                <p class="mt-2 text-sm leading-6 text-stone-500">
                    Dipakai untuk tipe khusus seperti FAQ. Boleh dikosongkan.
                </p>
            </div>

            <textarea name="settings_text" rows="10" class="{{ $inputClass }}"
                placeholder='Contoh FAQ:
{
  "items": [
    {
      "question": "Apakah bisa custom seragam?",
      "answer": "Bisa, silakan konsultasikan kebutuhan jumlah dan desain."
    }
  ]
}'>{{ $settingsText }}</textarea>
        </section>
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Gambar</p>
            <h3 class="mt-2 text-xl font-black text-stone-950">Gambar Section</h3>

            @if ($section->image)
                <div class="mt-6 overflow-hidden rounded-3xl border border-stone-200 bg-white p-3">
                    <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->title }}"
                        class="h-56 w-full rounded-2xl object-cover">
                </div>
            @endif

            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
                class="mt-5 block w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-600 file:mr-4 file:rounded-xl file:border-0 file:bg-stone-950 file:px-4 file:py-2 file:text-sm file:font-black file:text-amber-200">
        </section>

        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Status</p>
            <h3 class="mt-2 text-xl font-black text-stone-950">Pengaturan Tampil</h3>

            <label
                class="mt-6 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black text-stone-800">Aktif</span>
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $section->is_active))
                    class="rounded border-stone-300 text-stone-950 focus:ring-amber-300">
            </label>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 shadow-xl shadow-stone-900/10">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-300">Simpan</p>
            <h3 class="mt-2 text-xl font-black text-white">Simpan Section</h3>
            <p class="mt-3 text-sm leading-6 text-stone-300">
                Section akan tampil pada halaman sesuai urutan dan status aktif.
            </p>

            <button type="submit"
                class="mt-6 w-full rounded-2xl bg-amber-300 px-5 py-3.5 text-sm font-black text-stone-950 transition hover:bg-amber-200">
                Simpan
            </button>

            <a href="{{ route('admin.pages.sections.index', $page) }}"
                class="mt-3 inline-flex w-full justify-center rounded-2xl border border-white/10 px-5 py-3 text-sm font-black text-stone-200 transition hover:bg-white/10">
                Kembali
            </a>
        </section>
    </div>
</div>
