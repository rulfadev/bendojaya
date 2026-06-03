<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5">
                <x-admin.form.input name="question" label="Pertanyaan" :value="$faq->question" />

                <x-admin.form.textarea name="answer" label="Jawaban" :value="$faq->answer" rows="9" />
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.input name="category" label="Kategori" :value="$faq->category"
                placeholder="Custom / Kerja Sama / Pemesanan" />

            <div class="mt-5">
                <x-admin.form.input name="sort_order" label="Urutan" type="number" :value="$faq->sort_order" min="0" />
            </div>

            <div class="mt-5">
                <x-admin.form.toggle name="is_active" label="Aktif" :checked="$faq->is_active ?? true" />
            </div>

            <div class="mt-4">
                <x-admin.form.toggle name="is_featured" label="Tampil di Homepage" :checked="$faq->is_featured ?? true" />
            </div>
        </section>

        <x-admin.button class="w-full">
            <i class="fa-solid fa-save"></i>
            Simpan FAQ
        </x-admin.button>
    </div>
</div>
