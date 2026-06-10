@php
    $inputClass =
        'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition placeholder:text-stone-400 focus:border-stone-950 focus:ring-4 focus:ring-amber-200';

    $labelClass = 'mb-2 block text-sm font-black text-stone-800';

    $cardClass = 'rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm';

    $sectionTypes = [
        'hero' => 'Hero',
        'text' => 'Text',
        'image_text' => 'Image + Text',
        'gallery' => 'Gallery',
        'faq' => 'FAQ',
        'cta' => 'CTA',
        'raw_html' => 'Raw HTML',
    ];

    $imagePositions = [
        'left' => 'Gambar Kiri',
        'right' => 'Gambar Kanan',
    ];

    $settingsValue = old('settings_text');

    if ($settingsValue === null) {
        $settingsValue = $section->settings
            ? json_encode($section->settings, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
            : '';
    }
@endphp

<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="{{ $cardClass }}">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Page Section</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Konten Section</h3>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                @if (isset($page))
                    <input type="hidden" name="page_id" value="{{ $page->id }}">
                @elseif (isset($pages))
                    <div class="md:col-span-2">
                        <label for="page_id" class="{{ $labelClass }}">Halaman</label>
                        <select id="page_id" name="page_id" class="{{ $inputClass }}">
                            <option value="">Pilih halaman</option>
                            @foreach ($pages as $pageItem)
                                <option value="{{ $pageItem->id }}" @selected((int) old('page_id', $section->page_id) === (int) $pageItem->id)>
                                    {{ $pageItem->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div>
                    <label for="type" class="{{ $labelClass }}">Tipe Section</label>
                    <select id="type" name="type" class="{{ $inputClass }}">
                        @foreach ($sectionTypes as $value => $label)
                            <option value="{{ $value }}" @selected(old('type', $section->type) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="sort_order" class="{{ $labelClass }}">Urutan</label>
                    <input type="number" id="sort_order" name="sort_order"
                        value="{{ old('sort_order', $section->sort_order ?? 0) }}" min="0"
                        class="{{ $inputClass }}">
                </div>

                <div class="md:col-span-2">
                    <label for="eyebrow" class="{{ $labelClass }}">Eyebrow / Label Kecil</label>
                    <input type="text" id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $section->eyebrow) }}"
                        placeholder="Contoh: Bendo Jaya" class="{{ $inputClass }}">
                </div>

                <div class="md:col-span-2">
                    <label for="title" class="{{ $labelClass }}">Judul</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $section->title) }}"
                        placeholder="Judul section" class="{{ $inputClass }}">
                </div>

                <div class="md:col-span-2">
                    <label for="subtitle" class="{{ $labelClass }}">Subtitle / Deskripsi Pendek</label>
                    <textarea id="subtitle" name="subtitle" rows="3" class="{{ $inputClass }}"
                        placeholder="Deskripsi singkat section">{{ old('subtitle', $section->subtitle) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Konten</label>

                    @include('admin.shared.trix-editor', [
                        'name' => 'content',
                        'value' => old('content', $section->content ?? ''),
                        'id' => 'section_content',
                    ])

                    @error('content')
                        <p class="mt-2 text-xs font-bold text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    <p class="mt-2 text-xs font-semibold leading-6 text-stone-500">
                        Dipakai untuk section Text, Image + Text, dan Raw HTML. Untuk Raw HTML, isi tetap akan dirender
                        sebagai HTML.
                    </p>
                </div>
            </div>
        </section>

        <section class="{{ $cardClass }}">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Button</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Pengaturan Tombol</h3>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="button_label" class="{{ $labelClass }}">Label Tombol</label>
                    <input type="text" id="button_label" name="button_label"
                        value="{{ old('button_label', $section->button_label) }}" placeholder="Contoh: Selengkapnya"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label for="button_url" class="{{ $labelClass }}">URL Tombol</label>
                    <input type="text" id="button_url" name="button_url"
                        value="{{ old('button_url', $section->button_url) }}"
                        placeholder="/pages/kerja-sama atau https://..." class="{{ $inputClass }}">
                </div>
            </div>
        </section>

        <section class="{{ $cardClass }}">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Settings</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Data Tambahan JSON</h3>
                <p class="mt-2 text-sm font-semibold leading-7 text-stone-500">
                    Dipakai untuk section FAQ dan Gallery. Kosongkan jika section tidak membutuhkan data tambahan.
                </p>
            </div>

            <textarea id="settings_text" name="settings_text" rows="10" class="{{ $inputClass }}"
                placeholder='Contoh FAQ:
{
  "items": [
    {
      "question": "Apakah bisa custom batik?",
      "answer": "Bisa, Bendo Jaya melayani custom produksi batik."
    }
  ]
}'>{{ $settingsValue }}</textarea>

            @error('settings_text')
                <p class="mt-2 text-xs font-bold text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </section>

        @include('admin.shared.english-translation-fields', [
            'model' => $section,
            'fields' => [
                'eyebrow' => ['label' => 'Eyebrow / Label Kecil'],
                'title' => ['label' => 'Judul'],
                'subtitle' => ['label' => 'Subtitle / Deskripsi Pendek', 'type' => 'textarea', 'rows' => 3],
                'content' => ['label' => 'Konten', 'type' => 'editor', 'rows' => 8],
                'button_label' => ['label' => 'Label Tombol'],
                'settings' => ['label' => 'Settings JSON', 'type' => 'textarea', 'rows' => 10],
            ],
        ])
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Gambar</p>
            <h3 class="mt-2 text-xl font-black text-stone-950">Image Section</h3>

            @if ($section->image)
                <div class="mt-6 overflow-hidden rounded-3xl border border-stone-200 bg-white p-3">
                    <img src="{{ asset('storage/' . $section->image) }}"
                        alt="{{ $section->title ?: 'Section Image' }}" class="h-52 w-full rounded-2xl object-cover">
                </div>
            @endif

            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,.svg"
                class="mt-5 block w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-600 file:mr-4 file:rounded-xl file:border-0 file:bg-stone-950 file:px-4 file:py-2 file:text-sm file:font-black file:text-amber-200">

            <div class="mt-5">
                <label for="image_position" class="{{ $labelClass }}">Posisi Gambar</label>
                <select id="image_position" name="image_position" class="{{ $inputClass }}">
                    @foreach ($imagePositions as $value => $label)
                        <option value="{{ $value }}" @selected(old('image_position', $section->image_position ?? 'left') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </section>

        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Status</p>
            <h3 class="mt-2 text-xl font-black text-stone-950">Pengaturan</h3>

            <div class="mt-6 space-y-5">
                <label
                    class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                    <span class="text-sm font-black text-stone-800">Aktif</span>
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $section->is_active ?? true))>
                </label>
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 shadow-xl shadow-stone-900/10">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-300">Simpan</p>
            <h3 class="mt-2 text-xl font-black text-white">Simpan Section</h3>

            <button type="submit"
                class="mt-6 w-full rounded-2xl bg-amber-300 px-5 py-3.5 text-sm font-black text-stone-950 transition hover:bg-amber-200">
                Simpan
            </button>

            @if (isset($page))
                <a href="{{ route('admin.pages.edit', $page) }}"
                    class="mt-3 inline-flex w-full justify-center rounded-2xl border border-white/10 px-5 py-3 text-sm font-black text-stone-200 transition hover:bg-white/10">
                    Kembali
                </a>
            @else
                <a href="javascript:history.back()"
                    class="mt-3 inline-flex w-full justify-center rounded-2xl border border-white/10 px-5 py-3 text-sm font-black text-stone-200 transition hover:bg-white/10">
                    Kembali
                </a>
            @endif
        </section>
    </div>
</div>
