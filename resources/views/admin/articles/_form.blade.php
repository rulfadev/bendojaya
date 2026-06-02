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
                    <input type="text" name="title" value="{{ old('title', $article->title) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $article->slug) }}"
                        class="{{ $inputClass }}" placeholder="Kosongkan untuk otomatis">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $article->category) }}"
                        class="{{ $inputClass }}" placeholder="Batik Insight">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $article->sort_order) }}"
                        class="{{ $inputClass }}" min="0">
                </div>

                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Excerpt</label>
                    <textarea name="excerpt" rows="4" class="{{ $inputClass }}">{{ old('excerpt', $article->excerpt) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Konten</label>
                    <textarea name="content" rows="12" class="{{ $inputClass }}" placeholder="Boleh isi HTML sederhana">{{ old('content', $article->content) }}</textarea>
                </div>
            </div>
        </section>

        <section class="{{ $cardClass }}">
            <div class="grid gap-5">
                <div>
                    <label class="{{ $labelClass }}">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $article->meta_title) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="{{ $inputClass }}">{{ old('meta_description', $article->meta_description) }}</textarea>
                </div>

                <div>
                    <label class="{{ $labelClass }}">Meta Keywords</label>
                    <textarea name="meta_keywords" rows="3" class="{{ $inputClass }}">{{ old('meta_keywords', $article->meta_keywords) }}</textarea>
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Gambar</p>

            @if ($article->featured_image)
                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                    class="mt-5 h-56 w-full rounded-2xl object-cover">
            @endif

            <input type="file" name="featured_image" accept=".jpg,.jpeg,.png,.webp"
                class="mt-5 block w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm">
        </section>

        <section class="{{ $cardClass }}">
            <label class="{{ $labelClass }}">Tanggal Publish</label>
            <input type="datetime-local" name="published_at"
                value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}"
                class="{{ $inputClass }}">

            <label
                class="mt-5 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Aktif</span>
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $article->is_active))>
            </label>

            <label
                class="mt-4 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Tampil di Homepage</span>
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $article->is_featured))>
            </label>
        </section>

        <button type="submit" class="w-full rounded-2xl bg-stone-950 px-5 py-3.5 text-sm font-black text-amber-200">
            Simpan
        </button>
    </div>
</div>
