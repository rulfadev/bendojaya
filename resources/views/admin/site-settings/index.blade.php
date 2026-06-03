@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid gap-8 xl:grid-cols-3">
            <div class="space-y-8 xl:col-span-2">
                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <div class="mb-6">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                            Identitas Website
                        </p>
                        <h3 class="mt-2 text-xl font-black text-stone-950">
                            Informasi Brand
                        </h3>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <x-admin.form.input name="site_name" label="Nama Website" :value="$setting->site_name"
                            placeholder="Bendo Jaya" />

                        <x-admin.form.input name="site_tagline" label="Tagline" :value="$setting->site_tagline ?? null"
                            placeholder="Batik Fashion" />

                        <div class="md:col-span-2">
                            <x-admin.form.textarea name="site_description" label="Deskripsi Website" :value="$setting->site_description ?? null"
                                rows="4" />
                        </div>
                    </div>
                </section>

                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <div class="mb-6">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                            Kontak
                        </p>
                        <h3 class="mt-2 text-xl font-black text-stone-950">
                            Informasi Kontak & Konsultasi
                        </h3>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <x-admin.form.input name="email" label="Email" type="email" :value="$setting->email ?? null"
                            placeholder="admin@bendojaya.id" />

                        <x-admin.form.input name="whatsapp_number" label="Nomor WhatsApp" :value="$setting->whatsapp_number"
                            placeholder="628..." />

                        <div class="md:col-span-2">
                            <x-admin.form.textarea name="address" label="Alamat" :value="$setting->address ?? null" rows="3" />
                        </div>

                        <x-admin.form.input name="instagram_url" label="Instagram URL" type="url" :value="$setting->instagram_url ?? null" />

                        <x-admin.form.input name="tiktok_url" label="TikTok URL" type="url" :value="$setting->tiktok_url ?? null" />

                        <x-admin.form.input name="consultation_label" label="Label Tombol Konsultasi" :value="$setting->consultation_label"
                            placeholder="Konsultasi" />

                        <x-admin.form.input name="consultation_url" label="URL Konsultasi" :value="$setting->consultation_url"
                            placeholder="https://wa.me/628..." />
                    </div>
                </section>

                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <div class="mb-6">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                            SEO
                        </p>
                        <h3 class="mt-2 text-xl font-black text-stone-950">
                            Metadata Website
                        </h3>
                    </div>

                    <div class="grid gap-5">
                        <x-admin.form.input name="meta_title" label="Meta Title" :value="$setting->meta_title" />

                        <x-admin.form.textarea name="meta_description" label="Meta Description" :value="$setting->meta_description"
                            rows="3" />

                        <x-admin.form.textarea name="meta_keywords" label="Meta Keywords" :value="$setting->meta_keywords"
                            rows="3" />

                        <x-admin.form.file name="og_image" label="OG Image" accept=".jpg,.jpeg,.png,.webp"
                            :preview="$setting->og_image ? asset('storage/' . $setting->og_image) : null" preview-alt="OG Image" />
                    </div>
                </section>

                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <div class="mb-6">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                            Maintenance
                        </p>
                        <h3 class="mt-2 text-xl font-black text-stone-950">
                            Mode Perawatan Website
                        </h3>
                    </div>

                    <div class="grid gap-5">
                        <x-admin.form.toggle name="is_maintenance" label="Aktifkan Maintenance" :checked="$setting->is_maintenance ?? false" />

                        <x-admin.form.input name="maintenance_title" label="Judul Maintenance" :value="$setting->maintenance_title ?? null"
                            placeholder="Website sedang dalam perawatan" />

                        <x-admin.form.textarea name="maintenance_message" label="Pesan Maintenance" :value="$setting->maintenance_message ?? null"
                            rows="4" />
                    </div>
                </section>
            </div>

            <div class="space-y-8">
                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <p class="mb-5 text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                        Logo
                    </p>

                    <x-admin.form.file name="logo" label="Logo Website" accept=".jpg,.jpeg,.png,.webp,.svg"
                        :preview="$setting->logo ? asset('storage/' . $setting->logo) : null" preview-alt="Logo Website" />

                    <div class="mt-6">
                        <x-admin.form.file name="favicon" label="Favicon" accept=".jpg,.jpeg,.png,.webp,.ico,.svg"
                            :preview="$setting->favicon ? asset('storage/' . $setting->favicon) : null" preview-alt="Favicon" />
                    </div>
                </section>

                <section class="rounded-[2rem] bg-stone-950 p-6">
                    <x-admin.button variant="gold" class="w-full">
                        <i class="fa-solid fa-save"></i>
                        Simpan Pengaturan
                    </x-admin.button>
                </section>
            </div>
        </div>
    </form>
@endsection
