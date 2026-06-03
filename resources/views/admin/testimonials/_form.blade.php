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
                    <label class="{{ $labelClass }}">Nama Client</label>
                    <input type="text" name="name" value="{{ old('name', $testimonial->name) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Perusahaan / Brand</label>
                    <input type="text" name="company_name"
                        value="{{ old('company_name', $testimonial->company_name) }}" class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Jabatan</label>
                    <input type="text" name="position" value="{{ old('position', $testimonial->position) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Rating</label>
                    <select name="rating" class="{{ $inputClass }}">
                        <option value="">Pilih rating</option>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" @selected((int) old('rating', $testimonial->rating) === $i)>
                                {{ $i }} Bintang
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="{{ $labelClass }}">Email</label>
                    <input type="email" name="email" value="{{ old('email', $testimonial->email) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone', $testimonial->phone) }}"
                        class="{{ $inputClass }}">
                </div>

                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Testimoni</label>
                    <textarea name="message" rows="7" class="{{ $inputClass }}">{{ old('message', $testimonial->message) }}</textarea>
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <label class="{{ $labelClass }}">Status</label>
            <select name="status" class="{{ $inputClass }}">
                @foreach (\App\Models\Testimonial::STATUSES as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $testimonial->status) === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <label class="{{ $labelClass }} mt-5">Urutan</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order) }}"
                class="{{ $inputClass }}" min="0">

            <label
                class="mt-5 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Tampil di Homepage</span>
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $testimonial->is_featured))>
            </label>

            <label
                class="mt-4 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Izin Publikasi</span>
                <input type="checkbox" name="consent_to_publish" value="1" @checked(old('consent_to_publish', $testimonial->consent_to_publish))>
            </label>
        </section>

        <section class="{{ $cardClass }}">
            <label class="{{ $labelClass }}">Foto Client</label>
            @if ($testimonial->photo)
                <img src="{{ asset('storage/' . $testimonial->photo) }}"
                    class="mb-4 h-32 w-32 rounded-3xl object-cover">
            @endif
            <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-sm">

            <label class="{{ $labelClass }} mt-5">Logo Brand</label>
            @if ($testimonial->logo)
                <img src="{{ asset('storage/' . $testimonial->logo) }}"
                    class="mb-4 h-24 w-full rounded-2xl bg-white object-contain p-3">
            @endif
            <input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp,.svg" class="block w-full text-sm">
        </section>

        <button type="submit" class="w-full rounded-2xl bg-stone-950 px-5 py-3.5 text-sm font-black text-amber-200">
            Simpan
        </button>
    </div>
</div>
