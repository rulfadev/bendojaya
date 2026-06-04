@php
    $items = old(
        'items',
        $quotation->items
            ?->map(
                fn($item) => [
                    'item_name' => $item->item_name,
                    'description' => $item->description,
                    'quantity' => $item->quantity,
                    'unit' => $item->unit,
                    'unit_price' => $item->unit_price,
                ],
            )
            ->toArray() ?: [
            ['item_name' => '', 'description' => '', 'quantity' => 1, 'unit' => 'pcs', 'unit_price' => 0],
            ['item_name' => '', 'description' => '', 'quantity' => 1, 'unit' => 'pcs', 'unit_price' => 0],
            ['item_name' => '', 'description' => '', 'quantity' => 1, 'unit' => 'pcs', 'unit_price' => 0],
        ],
    );
@endphp

<input type="hidden" name="collection_inquiry_id"
    value="{{ old('collection_inquiry_id', $quotation->collection_inquiry_id) }}">
<input type="hidden" name="partnership_inquiry_id"
    value="{{ old('partnership_inquiry_id', $quotation->partnership_inquiry_id) }}">

<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <x-admin.form.input name="quotation_number" label="Nomor Penawaran" :value="$quotation->quotation_number" />

                <x-admin.form.select name="status" label="Status">
                    @foreach (\App\Models\Quotation::STATUSES as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $quotation->status) === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </x-admin.form.select>

                <div class="md:col-span-2">
                    <x-admin.form.input name="title" label="Judul Penawaran" :value="$quotation->title" />
                </div>

                <x-admin.form.input name="client_name" label="Nama Client" :value="$quotation->client_name" />

                <x-admin.form.input name="company_name" label="Perusahaan / Brand" :value="$quotation->company_name" />

                <x-admin.form.input name="email" label="Email" type="email" :value="$quotation->email" />

                <x-admin.form.input name="phone" label="WhatsApp" :value="$quotation->phone" />

                <x-admin.form.input name="quotation_date" label="Tanggal Penawaran" type="date" :value="$quotation->quotation_date?->format('Y-m-d') ?? $quotation->quotation_date" />

                <x-admin.form.input name="valid_until" label="Berlaku Sampai" type="date" :value="$quotation->valid_until?->format('Y-m-d') ?? $quotation->valid_until" />
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="mb-5">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Item Penawaran</p>
                <h3 class="mt-2 text-xl font-black text-stone-950">Rincian Produk / Layanan</h3>
            </div>

            <div class="space-y-5">
                @foreach ($items as $index => $item)
                    <div class="rounded-[1.5rem] border border-stone-200 bg-white p-5">
                        <div class="grid gap-4 md:grid-cols-12">
                            <div class="md:col-span-5">
                                <x-admin.form.input name="items[{{ $index }}][item_name]" label="Item"
                                    :value="$item['item_name'] ?? null" placeholder="Kemeja Batik Custom" />
                            </div>

                            <div class="md:col-span-2">
                                <x-admin.form.input name="items[{{ $index }}][quantity]" label="Qty"
                                    type="number" step="0.01" :value="$item['quantity'] ?? 1" />
                            </div>

                            <div class="md:col-span-2">
                                <x-admin.form.input name="items[{{ $index }}][unit]" label="Unit"
                                    :value="$item['unit'] ?? 'pcs'" />
                            </div>

                            <div class="md:col-span-3">
                                <x-admin.form.input name="items[{{ $index }}][unit_price]" label="Harga Satuan"
                                    type="number" step="0.01" :value="$item['unit_price'] ?? 0" />
                            </div>

                            <div class="md:col-span-12">
                                <x-admin.form.textarea name="items[{{ $index }}][description]"
                                    label="Deskripsi Item" :value="$item['description'] ?? null" rows="2" />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="mt-5 text-sm font-semibold text-stone-500">
                Untuk menambah item lebih banyak, simpan dulu lalu edit kembali. Versi awal dibuat sederhana agar
                stabil.
            </p>
        </section>
    </div>

    <div class="space-y-8">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.input name="discount_amount" label="Diskon" type="number" step="0.01"
                :value="$quotation->discount_amount ?? 0" />

            <div class="mt-5">
                <x-admin.form.input name="tax_amount" label="Pajak / Biaya Tambahan" type="number" step="0.01"
                    :value="$quotation->tax_amount ?? 0" />
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.textarea name="notes" label="Catatan" :value="$quotation->notes" rows="5" />

            <div class="mt-5">
                <x-admin.form.textarea name="terms" label="Syarat & Ketentuan" :value="$quotation->terms" rows="7" />
            </div>
        </section>

        <x-admin.button class="w-full">
            <i class="fa-solid fa-save"></i>
            Simpan Penawaran
        </x-admin.button>
    </div>
</div>
