@extends('layouts.frontend')

@section('content')
    <section class="bg-[#3C3B39] py-24 text-[#FBE9CB]">
        <div class="mx-auto max-w-3xl px-5 text-center lg:px-8">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">Client Feedback</p>
            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black">Form Testimoni</h1>
            <p class="mt-6 text-sm leading-7 text-[#E6D8C8]">
                Terima kasih sudah bekerja sama dengan Bendo Jaya. Silakan isi pengalaman Anda.
            </p>
        </div>
    </section>

    <section class="py-20">
        <div class="mx-auto max-w-3xl px-5 lg:px-8">
            <form action="{{ route('testimonial-form.submit', $testimonial) }}" method="POST" enctype="multipart/form-data"
                class="rounded-[2rem] border border-[#E6D8C8] bg-white p-7 shadow-sm">
                @csrf

                <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                <div class="grid gap-5 md:grid-cols-2">
                    <input name="name" value="{{ old('name', $testimonial->name) }}" placeholder="Nama"
                        class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">

                    <input name="company_name" value="{{ old('company_name', $testimonial->company_name) }}"
                        placeholder="Perusahaan / Brand"
                        class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">

                    <input name="position" value="{{ old('position', $testimonial->position) }}" placeholder="Jabatan"
                        class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">

                    <input name="email" value="{{ old('email', $testimonial->email) }}" placeholder="Email"
                        class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">

                    <input name="phone" value="{{ old('phone', $testimonial->phone) }}" placeholder="WhatsApp"
                        class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">

                    <select name="rating" class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">
                        <option value="">Pilih rating</option>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" @selected((int) old('rating', $testimonial->rating) === $i)>
                                {{ $i }} Bintang
                            </option>
                        @endfor
                    </select>

                    <div>
                        <label class="mb-2 block text-sm font-black text-[#3C3B39]">Foto Opsional</label>
                        <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-sm">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-black text-[#3C3B39]">Logo Opsional</label>
                        <input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp,.svg"
                            class="block w-full text-sm">
                    </div>

                    <textarea name="message" rows="7" placeholder="Tulis testimoni Anda"
                        class="md:col-span-2 rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">{{ old('message', $testimonial->message) }}</textarea>
                </div>

                <label class="mt-6 flex gap-3 text-sm leading-6 text-[#58433D]">
                    <input type="checkbox" name="consent_to_publish" value="1" class="mt-1">
                    <span>Saya mengizinkan testimoni ini ditampilkan di website Bendo Jaya.</span>
                </label>

                <button class="mt-7 w-full rounded-2xl bg-[#3C3B39] px-6 py-4 text-sm font-black text-[#FBE9CB]">
                    Kirim Testimoni
                </button>
            </form>
        </div>
    </section>
@endsection
