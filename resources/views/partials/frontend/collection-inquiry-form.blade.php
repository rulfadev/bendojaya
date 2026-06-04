<form action="{{ route('collections.inquiries.store', $collection) }}" method="POST" class="grid gap-4">
    @csrf

    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

    <div class="grid gap-4 md:grid-cols-2">
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="WhatsApp"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">
    </div>

    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email opsional"
        class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

    <div class="grid gap-4 md:grid-cols-3">
        <input type="text" name="size" value="{{ old('size') }}" placeholder="Ukuran / custom"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

        <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" placeholder="Jumlah"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

        <select name="need_type"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">
            <option value="">Kebutuhan</option>
            @foreach (\App\Models\CollectionInquiry::NEED_TYPES as $value => $label)
                <option value="{{ $value }}" @selected(old('need_type') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <textarea name="message" rows="5"
        placeholder="Ceritakan kebutuhan koleksi, bahan, ukuran, warna, atau custom yang diinginkan."
        class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">{{ old('message') }}</textarea>

    <button type="submit"
        class="rounded-2xl bg-[#3C3B39] px-6 py-4 text-sm font-black text-[#FBE9CB] transition hover:-translate-y-1 hover:bg-[#58433D]">
        Kirim Inquiry Koleksi
    </button>
</form>
