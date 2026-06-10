<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <x-admin.form.input name="title" label="Judul" :value="$article->title" />

                <x-admin.form.input name="slug" label="Slug" :value="$article->slug"
                    placeholder="Kosongkan untuk otomatis" />

                <x-admin.form.input name="category" label="Kategori" :value="$article->category" placeholder="Batik Insight" />

                <x-admin.form.input name="sort_order" label="Urutan" type="number" :value="$article->sort_order" min="0" />

                <div class="md:col-span-2">
                    <x-admin.form.textarea name="excerpt" label="Excerpt" :value="$article->excerpt" rows="4" />
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-black text-stone-700">
                        Konten
                    </label>

                    @include('admin.shared.trix-editor', [
                        'name' => 'content',
                        'value' => old('content', $article->content ?? ''),
                        'id' => 'article_content',
                    ])

                    @error('content')
                        <p class="mt-2 text-xs font-bold text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    <p class="mt-2 text-xs font-semibold leading-6 text-stone-500">
                        Gunakan editor ini untuk menulis artikel. Bisa menambahkan heading, list, link, gambar, dan
                        lampiran.
                    </p>
                </div>
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5">
                <x-admin.form.input name="meta_title" label="Meta Title" :value="$article->meta_title" />

                <x-admin.form.textarea name="meta_description" label="Meta Description" :value="$article->meta_description"
                    rows="3" />

                <x-admin.form.textarea name="meta_keywords" label="Meta Keywords" :value="$article->meta_keywords" rows="3" />
            </div>
        </section>

        @include('admin.shared.english-translation-fields', [
            'model' => $article,
            'fields' => [
                'title' => ['label' => 'Judul'],
                'category' => ['label' => 'Kategori'],
                'excerpt' => ['label' => 'Ringkasan', 'type' => 'textarea', 'rows' => 4],
                'content' => ['label' => 'Konten Artikel', 'type' => 'editor', 'rows' => 10],
                'meta_title' => ['label' => 'Meta Title'],
                'meta_description' => ['label' => 'Meta Description', 'type' => 'textarea', 'rows' => 3],
                'meta_keywords' => ['label' => 'Meta Keywords', 'type' => 'textarea', 'rows' => 3],
            ],
        ])
    </div>

    <div class="space-y-8">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.file name="featured_image" label="Gambar Artikel" accept=".jpg,.jpeg,.png,.webp"
                :preview="$article->featured_image ? asset('storage/' . $article->featured_image) : null" :preview-alt="$article->title ?: 'Gambar Artikel'" />
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.input name="published_at" label="Tanggal Publish" type="datetime-local" :value="$article->published_at?->format('Y-m-d\TH:i')" />

            <div class="mt-5">
                <x-admin.form.toggle name="is_active" label="Aktif" :checked="$article->is_active ?? true" />
            </div>

            <div class="mt-4">
                <x-admin.form.toggle name="is_featured" label="Tampil di Homepage" :checked="$article->is_featured ?? true" />
            </div>
        </section>

        <x-admin.button class="w-full">
            <i class="fa-solid fa-save"></i>
            Simpan Artikel
        </x-admin.button>
    </div>
</div>
