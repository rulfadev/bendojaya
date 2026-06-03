<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <x-admin.form.input name="name" label="Nama Koleksi" :value="$collection->name" />

                <x-admin.form.input name="slug" label="Slug" :value="$collection->slug"
                    placeholder="Kosongkan untuk otomatis" />

                <x-admin.form.input name="category" label="Kategori" :value="$collection->category"
                    placeholder="Dress / Outer / Setelan" />

                <x-admin.form.input name="sort_order" label="Urutan" type="number" :value="$collection->sort_order" min="0" />

                <div class="md:col-span-2">
                    <x-admin.form.textarea name="short_description" label="Deskripsi Singkat" :value="$collection->short_description"
                        rows="4" />
                </div>

                <div class="md:col-span-2">
                    <x-admin.form.textarea name="description" label="Deskripsi Lengkap" :value="$collection->description" rows="8"
                        placeholder="Boleh isi HTML sederhana" />
                </div>
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-3">
                <x-admin.form.input name="material" label="Bahan" :value="$collection->material"
                    placeholder="Katun / Rayon / Silk" />

                <x-admin.form.input name="color_palette" label="Warna" :value="$collection->color_palette"
                    placeholder="Maroon, Cream, Gold" />

                <x-admin.form.input name="size_info" label="Ukuran" :value="$collection->size_info"
                    placeholder="S, M, L, XL / Custom" />
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.file name="main_image" label="Gambar Utama" accept=".jpg,.jpeg,.png,.webp" :preview="$collection->main_image ? asset('storage/' . $collection->main_image) : null"
                :preview-alt="$collection->name ?: 'Gambar Koleksi'" />
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.toggle name="is_active" label="Aktif" :checked="$collection->is_active ?? true" />

            <div class="mt-4">
                <x-admin.form.toggle name="is_featured" label="Tampil di Homepage" :checked="$collection->is_featured ?? true" />
            </div>
        </section>

        <x-admin.button class="w-full">
            <i class="fa-solid fa-save"></i>
            Simpan Koleksi
        </x-admin.button>
    </div>
</div>
