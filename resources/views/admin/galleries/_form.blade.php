<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <x-admin.form.input name="title" label="Judul" :value="$gallery->title" />

                <x-admin.form.input name="slug" label="Slug" :value="$gallery->slug"
                    placeholder="Kosongkan untuk otomatis" />

                <x-admin.form.input name="category" label="Kategori" :value="$gallery->category" placeholder="Product Shoot" />

                <x-admin.form.input name="sort_order" label="Urutan" type="number" :value="$gallery->sort_order" min="0" />

                <div class="md:col-span-2">
                    <x-admin.form.textarea name="caption" label="Caption" :value="$gallery->caption" rows="4" />
                </div>

                <div class="md:col-span-2">
                    <x-admin.form.textarea name="description" label="Deskripsi" :value="$gallery->description" rows="7" />
                </div>
            </div>
        </section>
        @include('admin.shared.english-translation-fields', [
            'model' => $gallery,
            'fields' => [
                'title' => ['label' => 'Judul'],
                'category' => ['label' => 'Kategori'],
                'caption' => ['label' => 'Caption', 'type' => 'textarea', 'rows' => 4],
                'description' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rows' => 6],
            ],
        ])
    </div>

    <div class="space-y-8">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.file name="image" label="Gambar Gallery" accept=".jpg,.jpeg,.png,.webp" :preview="$gallery->image ? asset('storage/' . $gallery->image) : null"
                :preview-alt="$gallery->title ?: 'Gambar Gallery'" />
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.toggle name="is_active" label="Aktif" :checked="$gallery->is_active ?? true" />

            <div class="mt-4">
                <x-admin.form.toggle name="is_featured" label="Tampil di Homepage" :checked="$gallery->is_featured ?? true" />
            </div>
        </section>

        <x-admin.button class="w-full">
            <i class="fa-solid fa-save"></i>
            Simpan Gallery
        </x-admin.button>
    </div>
</div>
