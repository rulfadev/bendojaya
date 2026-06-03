<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <x-admin.form.input name="name" label="Nama Client" :value="$testimonial->name" />

                <x-admin.form.input name="company_name" label="Perusahaan / Brand" :value="$testimonial->company_name" />

                <x-admin.form.input name="position" label="Jabatan" :value="$testimonial->position" />

                <x-admin.form.select name="rating" label="Rating">
                    <option value="">Pilih rating</option>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected((int) old('rating', $testimonial->rating) === $i)>
                            {{ $i }} Bintang
                        </option>
                    @endfor
                </x-admin.form.select>

                <x-admin.form.input name="email" label="Email" type="email" :value="$testimonial->email" />

                <x-admin.form.input name="phone" label="WhatsApp" :value="$testimonial->phone" />

                <div class="md:col-span-2">
                    <x-admin.form.textarea name="message" label="Testimoni" :value="$testimonial->message" rows="7" />
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.select name="status" label="Status">
                @foreach (\App\Models\Testimonial::STATUSES as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $testimonial->status) === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </x-admin.form.select>

            <div class="mt-5">
                <x-admin.form.input name="sort_order" label="Urutan" type="number" :value="$testimonial->sort_order" min="0" />
            </div>

            <div class="mt-5">
                <x-admin.form.toggle name="is_featured" label="Tampil di Homepage" :checked="$testimonial->is_featured ?? false" />
            </div>

            <div class="mt-4">
                <x-admin.form.toggle name="consent_to_publish" label="Izin Publikasi" :checked="$testimonial->consent_to_publish ?? true" />
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.file name="photo" label="Foto Client" accept=".jpg,.jpeg,.png,.webp" :preview="$testimonial->photo ? asset('storage/' . $testimonial->photo) : null"
                :preview-alt="$testimonial->name ?: 'Foto Client'" />

            <div class="mt-6">
                <x-admin.form.file name="logo" label="Logo Brand" accept=".jpg,.jpeg,.png,.webp,.svg"
                    :preview="$testimonial->logo ? asset('storage/' . $testimonial->logo) : null" :preview-alt="$testimonial->company_name ?: 'Logo Brand'" />
            </div>
        </section>

        <x-admin.button class="w-full">
            <i class="fa-solid fa-save"></i>
            Simpan Testimoni
        </x-admin.button>
    </div>
</div>
