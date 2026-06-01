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
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Koleksi Batik</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Informasi Utama</h3>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="name" class="{{ $labelClass }}">Nama Koleksi</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $collection->name) }}"
                        class="{{ $inputClass }}" placeholder="Contoh: Batik Dress Maroon Elegan">
                </div>

                <div>
                    <label for="slug" class="{{ $labelClass }}">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $collection->slug) }}"
                        class="{{ $inputClass }}" placeholder="Kosongkan untuk otomatis">
                </div>

                <div>
                    <label for="category" class="{{ $labelClass }}">Kategori</label>
                    <input type="text" id="category" name="category"
                        value="{{ old('category', $collection->category) }}" class="{{ $inputClass }}"
                        placeholder="Contoh: Signature Collection">
                </div>

                <div>
                    <label for="sort_order" class="{{ $labelClass }}">Urutan</label>
                    <input type="number" id="sort_order" name="sort_order"
                        value="{{ old('sort_order', $collection->sort_order) }}" min="0"
                        class="{{ $inputClass }}">
                </div>

                <div class="md:col-span-2">
                    <label for="short_description" class="{{ $labelClass }}">Deskripsi Singkat</label>
                    <textarea id="short_description" name="short_description" rows="4" class="{{ $inputClass }}">{{ old('short_description', $collection->short_description) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="{{ $labelClass }}">Deskripsi Lengkap</label>
                    <textarea id="description" name="description" rows="8" class="{{ $inputClass }}">{{ old('description', $collection->description) }}</textarea>
                </div>
            </div>
        </section>

        <section class="{{ $cardClass }}">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Detail Produk</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Informasi Tambahan</h3>
            </div>

            <div class="grid gap-5 md:grid-cols-3">
                <div>
                    <label for="material" class="{{ $labelClass }}">Bahan</label>
                    <input type="text" id="material" name="material"
                        value="{{ old('material', $collection->material) }}" class="{{ $inputClass }}"
                        placeholder="Bahan batik premium">
                </div>

                <div>
                    <label for="color_palette" class="{{ $labelClass }}">Warna</label>
                    <input type="text" id="color_palette" name="color_palette"
                        value="{{ old('color_palette', $collection->color_palette) }}" class="{{ $inputClass }}"
                        placeholder="Maroon, coklat, krem">
                </div>

                <div>
                    <label for="size_info" class="{{ $labelClass }}">Ukuran</label>
                    <input type="text" id="size_info" name="size_info"
                        value="{{ old('size_info', $collection->size_info) }}" class="{{ $inputClass }}"
                        placeholder="All size / custom">
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Gambar</p>
            <h3 class="mt-2 text-xl font-black text-stone-950">Foto Utama</h3>

            @if ($collection->main_image)
                <div class="mt-6 overflow-hidden rounded-3xl border border-stone-200 bg-white p-3">
                    <img src="{{ asset('storage/' . $collection->main_image) }}" alt="{{ $collection->name }}"
                        class="h-72 w-full rounded-2xl object-cover">
                </div>
            @endif

            <input type="file" name="main_image" accept=".jpg,.jpeg,.png,.webp"
                class="mt-5 block w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-600 file:mr-4 file:rounded-xl file:border-0 file:bg-stone-950 file:px-4 file:py-2 file:text-sm file:font-black file:text-amber-200">

            <p class="mt-3 text-xs font-semibold leading-6 text-stone-500">
                Rekomendasi ukuran gambar koleksi: 900 x 1200 px atau rasio portrait 3:4.
            </p>
        </section>

        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Status</p>
            <h3 class="mt-2 text-xl font-black text-stone-950">Pengaturan Tampil</h3>

            <div class="mt-6 space-y-4">
                <label class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                    <span class="text-sm font-black text-stone-800">Aktif</span>
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $collection->is_active))
                        class="rounded border-stone-300 text-stone-950 focus:ring-amber-300">
                </label>

                <label
                    class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                    <span class="text-sm font-black text-stone-800">Tampil di Homepage</span>
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $collection->is_featured))
                        class="rounded border-stone-300 text-stone-950 focus:ring-amber-300">
                </label>
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 shadow-xl shadow-stone-900/10">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-300">Simpan</p>
            <h3 class="mt-2 text-xl font-black text-white">Simpan Koleksi</h3>

            <button type="submit"
                class="mt-6 w-full rounded-2xl bg-amber-300 px-5 py-3.5 text-sm font-black text-stone-950 transition hover:bg-amber-200">
                Simpan
            </button>

            <a href="{{ route('admin.collections.index') }}"
                class="mt-3 inline-flex w-full justify-center rounded-2xl border border-white/10 px-5 py-3 text-sm font-black text-stone-200 transition hover:bg-white/10">
                Kembali
            </a>
        </section>
    </div>
</div>
