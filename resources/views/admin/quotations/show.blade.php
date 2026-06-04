@extends('layouts.admin')

@section('content')
    <div class="grid gap-8 xl:grid-cols-3">
        <div class="space-y-8 xl:col-span-2">
            <section id="quotation-print-area" class="rounded-[2rem] border border-stone-200 bg-white p-8 shadow-sm">
                <div
                    class="flex flex-col gap-6 border-b border-stone-200 pb-6 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Quotation</p>
                        <h1 class="mt-2 text-3xl font-black text-stone-950">{{ $quotation->quotation_number }}</h1>
                        <p class="mt-2 text-sm font-semibold text-stone-500">
                            {{ $quotation->title ?: 'Penawaran Bendo Jaya' }}</p>
                    </div>

                    <div class="text-sm leading-7 text-stone-600 sm:text-right">
                        <p>Tanggal: {{ $quotation->quotation_date?->format('d M Y') ?: '-' }}</p>
                        <p>Berlaku sampai: {{ $quotation->valid_until?->format('d M Y') ?: '-' }}</p>
                    </div>
                </div>

                <div class="mt-8 grid gap-6 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-stone-500">Client</p>
                        <h3 class="mt-2 text-xl font-black text-stone-950">{{ $quotation->client_name }}</h3>
                        <p class="mt-1 text-sm text-stone-600">{{ $quotation->company_name ?: '-' }}</p>
                        <p class="mt-1 text-sm text-stone-600">{{ $quotation->email ?: '-' }}</p>
                        <p class="mt-1 text-sm text-stone-600">{{ $quotation->phone ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-stone-500">Status</p>
                        <p class="mt-2 text-lg font-black text-stone-950">{{ $quotation->status_label }}</p>
                    </div>
                </div>

                <div class="mt-8 overflow-hidden rounded-[1.5rem] border border-stone-200">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                            <tr>
                                <th class="px-5 py-4">Item</th>
                                <th class="px-5 py-4 text-right">Qty</th>
                                <th class="px-5 py-4 text-right">Harga</th>
                                <th class="px-5 py-4 text-right">Subtotal</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-stone-200">
                            @foreach ($quotation->items as $item)
                                <tr class="align-top">
                                    <td class="px-5 py-4">
                                        <p class="font-black text-stone-950">{{ $item->item_name }}</p>
                                        @if ($item->description)
                                            <p class="mt-1 whitespace-pre-line text-xs leading-6 text-stone-500">
                                                {{ $item->description }}</p>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-right text-stone-600">{{ $item->quantity }}
                                        {{ $item->unit }}</td>
                                    <td class="px-5 py-4 text-right text-stone-600">Rp
                                        {{ number_format((float) $item->unit_price, 0, ',', '.') }}</td>
                                    <td class="px-5 py-4 text-right font-bold text-stone-950">
                                        {{ $item->formatted_subtotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-end">
                    <div class="w-full max-w-sm space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-stone-500">Subtotal</span>
                            <span class="font-bold text-stone-950">Rp
                                {{ number_format((float) $quotation->subtotal, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-stone-500">Diskon</span>
                            <span class="font-bold text-stone-950">Rp
                                {{ number_format((float) $quotation->discount_amount, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-stone-500">Pajak / Tambahan</span>
                            <span class="font-bold text-stone-950">Rp
                                {{ number_format((float) $quotation->tax_amount, 0, ',', '.') }}</span>
                        </div>

                        <div class="border-t border-stone-200 pt-3">
                            <div class="flex justify-between text-lg">
                                <span class="font-black text-stone-950">Total</span>
                                <span class="font-black text-stone-950">{{ $quotation->formatted_total }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($quotation->notes)
                    <div class="mt-8 rounded-[1.5rem] bg-[#fbf7ef] p-5">
                        <p class="font-black text-stone-950">Catatan</p>
                        <p class="mt-2 whitespace-pre-line text-sm leading-7 text-stone-600">{{ $quotation->notes }}</p>
                    </div>
                @endif

                @if ($quotation->terms)
                    <div class="mt-6 rounded-[1.5rem] bg-[#fbf7ef] p-5">
                        <p class="font-black text-stone-950">Syarat & Ketentuan</p>
                        <p class="mt-2 whitespace-pre-line text-sm leading-7 text-stone-600">{{ $quotation->terms }}</p>
                    </div>
                @endif
            </section>
        </div>

        <div class="space-y-8">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">Status</p>

                <form action="{{ route('admin.quotations.status', $quotation) }}" method="POST" class="mt-5 space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-admin.form.select name="status" label="Ubah Status">
                        @foreach (\App\Models\Quotation::STATUSES as $value => $label)
                            <option value="{{ $value }}" @selected($quotation->status === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </x-admin.form.select>

                    <x-admin.button class="w-full">
                        Simpan Status
                    </x-admin.button>
                </form>
            </section>

            <section class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 shadow-sm">
                <x-admin.link-button :href="route('admin.quotations.index')" variant="light" class="w-full">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </x-admin.link-button>

                <x-admin.link-button :href="route('admin.quotations.edit', $quotation)" variant="light" class="mt-3 w-full">
                    <i class="fa-solid fa-edit"></i>
                    Edit
                </x-admin.link-button>

                <x-admin.link-button :href="$quotation->public_url" variant="light" target="_blank" class="mt-3 w-full">
                    <i class="fa-solid fa-up-right-from-square"></i>
                    Buka Link Public
                </x-admin.link-button>

                @if ($quotation->phone)
                    <x-admin.link-button :href="$quotation->whatsapp_url" variant="gold" target="_blank" class="mt-3 w-full">
                        <i class="fa-brands fa-whatsapp"></i>
                        Kirim via WhatsApp
                    </x-admin.link-button>
                @endif

                <div class="mt-3 rounded-2xl border border-white/10 bg-white/5 p-3">
                    <p class="mb-2 text-xs font-black uppercase tracking-[0.18em] text-amber-300">
                        Public Link
                    </p>

                    <input type="text" readonly value="{{ $quotation->public_url }}"
                        onclick="this.select(); navigator.clipboard.writeText(this.value);"
                        class="w-full rounded-xl border border-white/10 bg-white px-3 py-2 text-xs font-semibold text-stone-700">
                </div>

                <button type="button" onclick="window.print()"
                    class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white px-5 py-3 text-sm font-black text-stone-800">
                    <i class="fa-solid fa-print"></i>
                    Print
                </button>
            </section>

            <form action="{{ route('admin.quotations.destroy', $quotation) }}" method="POST"
                onsubmit="return confirm('Yakin hapus quotation ini?')">
                @csrf
                @method('DELETE')

                <x-admin.button variant="danger" class="w-full">
                    <i class="fa-solid fa-trash"></i>
                    Hapus Quotation
                </x-admin.button>
            </form>
        </div>
    </div>
@endsection
