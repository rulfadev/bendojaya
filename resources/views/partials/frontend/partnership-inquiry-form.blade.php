<form action="{{ route('partnership-inquiries.store') }}" method="POST" class="grid gap-4">
    @csrf

    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

    <div class="grid gap-4 md:grid-cols-2">
        <input type="text" name="company_name" value="{{ old('company_name') }}"
            placeholder="Nama brand/perusahaan/komunitas"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

        <input type="text" name="pic_name" value="{{ old('pic_name') }}" placeholder="Nama PIC"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email opsional"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="WhatsApp"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <select name="partnership_type"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">
            <option value="">Jenis Kerja Sama</option>
            @foreach (\App\Models\PartnershipInquiry::PARTNERSHIP_TYPES as $value => $label)
                <option value="{{ $value }}" @selected(old('partnership_type') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>

        <input type="number" name="estimated_quantity" value="{{ old('estimated_quantity') }}" min="1"
            placeholder="Estimasi jumlah"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

        <select name="budget_range"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">
            <option value="">Budget opsional</option>
            @foreach (\App\Models\PartnershipInquiry::BUDGET_RANGES as $value => $label)
                <option value="{{ $value }}" @selected(old('budget_range') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <input type="date" name="deadline_date" value="{{ old('deadline_date') }}"
        class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

    <textarea name="message" rows="6"
        placeholder="Ceritakan kebutuhan kerja sama, konsep produk, jumlah produksi, motif, bahan, warna, deadline, atau catatan lainnya."
        class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">{{ old('message') }}</textarea>

    <button type="submit"
        class="rounded-2xl bg-[#3C3B39] px-6 py-4 text-sm font-black text-[#FBE9CB] transition hover:-translate-y-1 hover:bg-[#58433D]">
        Kirim Inquiry Kerja Sama
    </button>
</form>
