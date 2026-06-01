@extends('layouts.admin')

@section('content')
    @php
        $inputClass =
            'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition placeholder:text-stone-400 focus:border-stone-950 focus:ring-4 focus:ring-amber-200';
        $labelClass = 'mb-2 block text-sm font-black text-stone-800';
        $cardClass = 'rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm';
    @endphp

    <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid gap-8 xl:grid-cols-3">
            <div class="space-y-8 xl:col-span-2">
                <section class="{{ $cardClass }}">
                    <div class="mb-6">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Identitas Brand</p>
                        <h3 class="mt-2 text-xl font-black text-stone-950">Informasi Utama</h3>
                        <p class="mt-2 text-sm leading-6 text-stone-500">
                            Data ini akan digunakan untuk homepage, meta default, dan bagian footer.
                        </p>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="site_name" class="{{ $labelClass }}">Nama Website</label>
                            <input type="text" id="site_name" name="site_name"
                                value="{{ old('site_name', $setting->site_name) }}" class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label for="tagline" class="{{ $labelClass }}">Tagline</label>
                            <input type="text" id="tagline" name="tagline"
                                value="{{ old('tagline', $setting->tagline) }}" class="{{ $inputClass }}">
                        </div>

                        <div class="md:col-span-2">
                            <label for="short_description" class="{{ $labelClass }}">Deskripsi Singkat</label>
                            <textarea id="short_description" name="short_description" rows="5" class="{{ $inputClass }}">{{ old('short_description', $setting->short_description) }}</textarea>
                        </div>
                    </div>
                </section>

                <section class="{{ $cardClass }}">
                    <div class="mb-6">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Kontak</p>
                        <h3 class="mt-2 text-xl font-black text-stone-950">Informasi Kontak</h3>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="email" class="{{ $labelClass }}">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $setting->email) }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label for="phone" class="{{ $labelClass }}">Telepon</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $setting->phone) }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label for="whatsapp_number" class="{{ $labelClass }}">Nomor WhatsApp</label>
                            <input type="text" id="whatsapp_number" name="whatsapp_number"
                                value="{{ old('whatsapp_number', $setting->whatsapp_number) }}" placeholder="628xxxxxxxxxx"
                                class="{{ $inputClass }}">
                            <p class="mt-2 text-xs font-semibold text-stone-500">Gunakan format 628..., tanpa tanda +.</p>
                        </div>

                        <div>
                            <label for="consultation_label" class="{{ $labelClass }}">Label Tombol Konsultasi</label>
                            <input type="text" id="consultation_label" name="consultation_label"
                                value="{{ old('consultation_label', $setting->consultation_label) }}"
                                placeholder="Konsultasi" class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label for="consultation_url" class="{{ $labelClass }}">Link Tombol Konsultasi</label>
                            <input type="text" id="consultation_url" name="consultation_url"
                                value="{{ old('consultation_url', $setting->consultation_url) }}"
                                placeholder="/pages/kerja-sama atau https://wa.me/628..." class="{{ $inputClass }}">
                            <p class="mt-2 text-xs font-semibold text-stone-500">
                                Bisa isi link internal seperti /pages/kerja-sama atau link eksternal seperti WhatsApp.
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="{{ $labelClass }}">Alamat</label>
                            <textarea id="address" name="address" rows="4" class="{{ $inputClass }}">{{ old('address', $setting->address) }}</textarea>
                        </div>
                    </div>
                </section>

                <section class="{{ $cardClass }}">
                    <div class="mb-6">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Sosial Media</p>
                        <h3 class="mt-2 text-xl font-black text-stone-950">Channel Digital</h3>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        @foreach ([
            'instagram_url' => 'Instagram URL',
            'tiktok_url' => 'TikTok URL',
            'facebook_url' => 'Facebook URL',
            'youtube_url' => 'YouTube URL',
        ] as $field => $label)
                            <div>
                                <label for="{{ $field }}" class="{{ $labelClass }}">{{ $label }}</label>
                                <input type="url" id="{{ $field }}" name="{{ $field }}"
                                    value="{{ old($field, $setting->{$field}) }}" placeholder="https://..."
                                    class="{{ $inputClass }}">
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="{{ $cardClass }}">
                    <div class="mb-6">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">SEO</p>
                        <h3 class="mt-2 text-xl font-black text-stone-950">Metadata Default</h3>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label for="meta_title" class="{{ $labelClass }}">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title"
                                value="{{ old('meta_title', $setting->meta_title) }}" class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label for="meta_description" class="{{ $labelClass }}">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" rows="4" class="{{ $inputClass }}">{{ old('meta_description', $setting->meta_description) }}</textarea>
                        </div>

                        <div>
                            <label for="meta_keywords" class="{{ $labelClass }}">Meta Keywords</label>
                            <textarea id="meta_keywords" name="meta_keywords" rows="4" class="{{ $inputClass }}">{{ old('meta_keywords', $setting->meta_keywords) }}</textarea>
                        </div>
                    </div>
                </section>
            </div>

            <div class="space-y-8">
                <section class="{{ $cardClass }}">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Logo</p>
                    <h3 class="mt-2 text-xl font-black text-stone-950">Logo Website</h3>

                    <div class="mt-6 rounded-3xl border border-stone-200 bg-white/70 p-5">
                        @if ($setting->logo)
                            <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->site_name }}"
                                class="max-h-24 rounded-2xl object-contain">
                        @else
                            <div
                                class="flex h-24 items-center justify-center rounded-2xl bg-stone-950 text-2xl font-black text-amber-300">
                                BJ
                            </div>
                        @endif
                    </div>

                    <input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp,.svg"
                        class="mt-5 block w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-600 file:mr-4 file:rounded-xl file:border-0 file:bg-stone-950 file:px-4 file:py-2 file:text-sm file:font-black file:text-amber-200">
                </section>

                <section class="{{ $cardClass }}">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Favicon</p>
                    <h3 class="mt-2 text-xl font-black text-stone-950">Ikon Browser</h3>

                    <div class="mt-6 rounded-3xl border border-stone-200 bg-white/70 p-5">
                        @if ($setting->favicon)
                            <img src="{{ asset('storage/' . $setting->favicon) }}" alt="Favicon"
                                class="h-14 w-14 rounded-2xl object-contain">
                        @else
                            <div
                                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-sm font-black text-amber-800">
                                Icon
                            </div>
                        @endif
                    </div>

                    <input type="file" name="favicon" accept=".jpg,.jpeg,.png,.webp,.ico,.svg"
                        class="mt-5 block w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-600 file:mr-4 file:rounded-xl file:border-0 file:bg-stone-950 file:px-4 file:py-2 file:text-sm file:font-black file:text-amber-200">
                </section>

                <section class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 shadow-xl shadow-stone-900/10">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-300">Simpan</p>
                    <h3 class="mt-2 text-xl font-black text-white">Perbarui Website</h3>
                    <p class="mt-3 text-sm leading-6 text-stone-300">
                        Simpan perubahan identitas, kontak, sosial media, dan SEO website.
                    </p>

                    <button type="submit"
                        class="mt-6 w-full rounded-2xl bg-amber-300 px-5 py-3.5 text-sm font-black text-stone-950 transition hover:bg-amber-200">
                        Simpan Pengaturan
                    </button>
                </section>
            </div>
        </div>
    </form>
@endsection
