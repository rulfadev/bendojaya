<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <x-admin.form.input name="title" label="Judul Layanan" :value="$service->title" />

                <x-admin.form.input name="slug" label="Slug" :value="$service->slug"
                    placeholder="Kosongkan untuk otomatis" />

                <x-admin.form.input name="sort_order" label="Urutan" type="number" :value="$service->sort_order" min="0" />

                <div class="md:col-span-2">
                    <x-admin.form.textarea name="short_description" label="Deskripsi Singkat" :value="$service->short_description"
                        rows="4" />
                </div>

                <div class="md:col-span-2">
                    <x-admin.form.textarea name="description" label="Deskripsi Lengkap" :value="$service->description" rows="8"
                        placeholder="Boleh isi HTML sederhana" />
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.file name="image" label="Gambar Layanan" accept=".jpg,.jpeg,.png,.webp" :preview="$service->image ? asset('storage/' . $service->image) : null"
                :preview-alt="$service->title ?: 'Gambar Layanan'" />
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.toggle name="is_active" label="Aktif" :checked="$service->is_active ?? true" />

            <div class="mt-4">
                <x-admin.form.toggle name="is_featured" label="Tampil di Homepage" :checked="$service->is_featured ?? true" />
            </div>

            <div class="mt-4">
                <x-admin.form.toggle name="show_button" label="Tampilkan Tombol" :checked="$service->show_button ?? true" />
            </div>

            <div class="mt-5">
                <x-admin.form.input name="button_label" label="Label Tombol" :value="$service->button_label"
                    placeholder="Konsultasi" />
            </div>

            <div class="mt-5">
                <x-admin.form.input name="button_url" label="URL Tombol" :value="$service->button_url"
                    placeholder="/pages/kerja-sama atau https://wa.me/628..." />
            </div>
        </section>

        <x-admin.button class="w-full">
            <i class="fa-solid fa-save"></i>
            Simpan Layanan
        </x-admin.button>
    </div>
</div>
