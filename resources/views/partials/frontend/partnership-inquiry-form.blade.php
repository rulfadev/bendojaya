<form action="{{ route('partnership-inquiries.store') }}" method="POST" class="grid gap-5">
    @csrf

    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

    <div class="grid gap-4 md:grid-cols-2">
        <x-admin.form.input name="company_name" label="Brand / Perusahaan / Komunitas" :value="old('company_name')"
            placeholder="Contoh: Bendo Jaya Group" />

        <x-admin.form.input name="pic_name" label="Nama PIC" :value="old('pic_name')" placeholder="Nama penanggung jawab" />
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <x-admin.form.input name="email" label="Email" type="email" :value="old('email')"
            placeholder="Email opsional" />

        <x-admin.form.input name="phone" label="WhatsApp" :value="old('phone')" placeholder="Contoh: 62812xxxx" />
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <x-admin.form.select name="partnership_type" label="Jenis Kerja Sama">
            <option value="">Pilih jenis kerja sama</option>

            @foreach (\App\Models\PartnershipInquiry::PARTNERSHIP_TYPES as $value => $label)
                <option value="{{ $value }}" @selected(old('partnership_type') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </x-admin.form.select>

        <x-admin.form.input name="estimated_quantity" label="Estimasi Jumlah" type="number" :value="old('estimated_quantity')"
            min="1" placeholder="Contoh: 50" />

        <x-admin.form.select name="budget_range" label="Budget">
            <option value="">Pilih budget</option>

            @foreach (\App\Models\PartnershipInquiry::BUDGET_RANGES as $value => $label)
                <option value="{{ $value }}" @selected(old('budget_range') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </x-admin.form.select>
    </div>

    <x-admin.form.input name="deadline_date" label="Deadline Kebutuhan" type="date" :value="old('deadline_date')" />

    <x-admin.form.textarea name="message" label="Catatan Kebutuhan" :value="old('message')" rows="6"
        placeholder="Ceritakan kebutuhan kerja sama, konsep produk, jumlah produksi, motif, bahan, warna, deadline, atau catatan lainnya." />

    <x-admin.button class="w-full">
        Kirim Proposal Kerja Sama
        <i class="fa-solid fa-arrow-right text-xs"></i>
    </x-admin.button>
</form>
