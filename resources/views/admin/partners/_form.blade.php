<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <x-admin.form.input name="name" label="Nama Partner" :value="$partner->name" />

                <x-admin.form.input name="slug" label="Slug" :value="$partner->slug"
                    placeholder="Kosongkan untuk otomatis" />

                <x-admin.form.input name="category" label="Kategori" :value="$partner->category" placeholder="Brand Fashion" />

                <x-admin.form.input name="sort_order" label="Urutan" type="number" :value="$partner->sort_order" min="0" />

                <div class="md:col-span-2">
                    <x-admin.form.textarea name="description" label="Deskripsi" :value="$partner->description" rows="5" />
                </div>

                <x-admin.form.input name="website_url" label="Website URL" type="url" :value="$partner->website_url" />

                <x-admin.form.input name="instagram_url" label="Instagram URL" type="url" :value="$partner->instagram_url" />

                <x-admin.form.input name="whatsapp_number" label="WhatsApp" :value="$partner->whatsapp_number" placeholder="628..." />
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.file name="logo" label="Logo Partner" accept=".jpg,.jpeg,.png,.webp,.svg" :preview="$partner->logo ? asset('storage/' . $partner->logo) : null"
                :preview-alt="$partner->name ?: 'Logo Partner'" />
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.toggle name="is_active" label="Aktif" :checked="$partner->is_active ?? true" />

            <div class="mt-4">
                <x-admin.form.toggle name="is_featured" label="Tampil di Homepage" :checked="$partner->is_featured ?? true" />
            </div>
        </section>

        <x-admin.button class="w-full">
            <i class="fa-solid fa-save"></i>
            Simpan Partner
        </x-admin.button>
    </div>
</div>
