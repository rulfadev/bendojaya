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
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Custom Page</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Konten Halaman</h3>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="title" class="{{ $labelClass }}">Judul Halaman</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $page->title) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label for="slug" class="{{ $labelClass }}">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $page->slug) }}"
                        placeholder="kosongkan untuk otomatis" class="{{ $inputClass }}">
                </div>

                <div class="md:col-span-2">
                    <label for="excerpt" class="{{ $labelClass }}">Ringkasan</label>
                    <textarea id="excerpt" name="excerpt" rows="3" class="{{ $inputClass }}">{{ old('excerpt', $page->excerpt) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="content" class="{{ $labelClass }}">Konten</label>
                    <textarea id="content" name="content" rows="12" class="{{ $inputClass }}"
                        placeholder="Boleh isi HTML sederhana seperti <p>...</p>">{{ old('content', $page->content) }}</textarea>
                </div>
            </div>
        </section>

        <section class="{{ $cardClass }}">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">SEO</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Metadata Halaman</h3>
            </div>

            <div class="space-y-5">
                <div>
                    <label for="meta_title" class="{{ $labelClass }}">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title"
                        value="{{ old('meta_title', $page->meta_title) }}" class="{{ $inputClass }}">
                </div>

                <div>
                    <label for="meta_description" class="{{ $labelClass }}">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3" class="{{ $inputClass }}">{{ old('meta_description', $page->meta_description) }}</textarea>
                </div>

                <div>
                    <label for="meta_keywords" class="{{ $labelClass }}">Meta Keywords</label>
                    <textarea id="meta_keywords" name="meta_keywords" rows="3" class="{{ $inputClass }}">{{ old('meta_keywords', $page->meta_keywords) }}</textarea>
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Gambar</p>
            <h3 class="mt-2 text-xl font-black text-stone-950">Featured Image</h3>

            @if ($page->featured_image)
                <div class="mt-6 overflow-hidden rounded-3xl border border-stone-200 bg-white p-3">
                    <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}"
                        class="h-48 w-full rounded-2xl object-cover">
                </div>
            @endif

            <input type="file" name="featured_image" accept=".jpg,.jpeg,.png,.webp,.svg"
                class="mt-5 block w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-600 file:mr-4 file:rounded-xl file:border-0 file:bg-stone-950 file:px-4 file:py-2 file:text-sm file:font-black file:text-amber-200">
        </section>

        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Status</p>
            <h3 class="mt-2 text-xl font-black text-stone-950">Pengaturan</h3>

            <div class="mt-6 space-y-5">
                <div>
                    <label for="sort_order" class="{{ $labelClass }}">Urutan</label>
                    <input type="number" id="sort_order" name="sort_order"
                        value="{{ old('sort_order', $page->sort_order) }}" min="0" class="{{ $inputClass }}">
                </div>

                <div>
                    <label for="published_at" class="{{ $labelClass }}">Tanggal Publish</label>
                    <input type="datetime-local" id="published_at" name="published_at"
                        value="{{ old('published_at', $page->published_at?->format('Y-m-d\TH:i')) }}"
                        class="{{ $inputClass }}">
                </div>

                <label class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                    <span class="text-sm font-black text-stone-800">Aktif</span>
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $page->is_active))>
                </label>

                <label class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                    <span class="text-sm font-black text-stone-800">Tampil di Navigasi</span>
                    <input type="checkbox" name="show_in_navigation" value="1" @checked(old('show_in_navigation', $page->show_in_navigation))>
                </label>
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 shadow-xl shadow-stone-900/10">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-300">Simpan</p>
            <h3 class="mt-2 text-xl font-black text-white">Simpan Halaman</h3>

            <button type="submit"
                class="mt-6 w-full rounded-2xl bg-amber-300 px-5 py-3.5 text-sm font-black text-stone-950 transition hover:bg-amber-200">
                Simpan
            </button>

            <a href="{{ route('admin.pages.index') }}"
                class="mt-3 inline-flex w-full justify-center rounded-2xl border border-white/10 px-5 py-3 text-sm font-black text-stone-200 transition hover:bg-white/10">
                Kembali
            </a>
        </section>
    </div>
</div>
