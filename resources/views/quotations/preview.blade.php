<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? $quotation->quotation_number }}</title>
    <meta name="robots" content="noindex, nofollow">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .quotation-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .quotation-table th,
        .quotation-table td {
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        @media print {
            @page {
                size: A4;
                margin: 14mm;
            }

            .no-print {
                display: none !important;
            }

            body {
                background: #ffffff !important;
            }

            .print-card {
                box-shadow: none !important;
                border: 0 !important;
                padding: 0 !important;
            }

            .print-card,
            .print-card * {
                max-width: 100% !important;
            }

            .quotation-table {
                width: 100% !important;
                table-layout: fixed !important;
                font-size: 11px !important;
            }

            .quotation-table th,
            .quotation-table td {
                padding: 10px 8px !important;
                word-break: break-word !important;
                overflow-wrap: anywhere !important;
                white-space: normal !important;
            }

            .quotation-table .col-item {
                width: 46% !important;
            }

            .quotation-table .col-qty {
                width: 14% !important;
            }

            .quotation-table .col-price {
                width: 20% !important;
            }

            .quotation-table .col-subtotal {
                width: 20% !important;
            }
        }
    </style>
</head>

<body class="bg-[#FFF8ED] text-[#3C3B39] antialiased">
    <main class="min-h-screen px-5 py-8 lg:px-8">
        <div class="mx-auto max-w-5xl">
            @if (session('success'))
                <div
                    class="no-print mb-6 rounded-3xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <div
                class="no-print mb-6 flex flex-col gap-4 rounded-[2rem] border border-[#E6D8C8] bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                        Public Quotation
                    </p>
                    <h1 class="mt-2 text-xl font-black text-[#3C3B39]">
                        {{ $quotation->quotation_number }}
                    </h1>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <button type="button" onclick="window.print()"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-[#765A4F]/25 bg-white px-5 py-3 text-sm font-black text-[#765A4F] transition hover:bg-[#765A4F] hover:text-white">
                        <i class="fa-solid fa-print"></i>
                        Print / PDF
                    </button>
                </div>
            </div>

            <section class="print-card rounded-[2.5rem] border border-[#E6D8C8] bg-white p-6 shadow-sm sm:p-10">
                <div
                    class="flex flex-col gap-8 border-b border-[#E6D8C8] pb-8 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                            Bendo Jaya Batik Fashion
                        </p>

                        <h2 class="mt-4 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39]">
                            Penawaran Harga
                        </h2>

                        <p class="mt-3 text-sm font-semibold text-[#7F756D]">
                            {{ $quotation->title ?: 'Penawaran Bendo Jaya' }}
                        </p>
                    </div>

                    <div class="rounded-[1.5rem] bg-[#FFF8ED] p-5 text-sm leading-7 text-[#7F756D] sm:text-right">
                        <p class="font-black text-[#3C3B39]">{{ $quotation->quotation_number }}</p>
                        <p>Tanggal: {{ $quotation->quotation_date?->format('d M Y') ?: '-' }}</p>
                        <p>Berlaku sampai: {{ $quotation->valid_until?->format('d M Y') ?: '-' }}</p>
                    </div>
                </div>

                <div class="mt-8 grid gap-6 sm:grid-cols-2">
                    <div class="rounded-[1.5rem] border border-[#E6D8C8] p-5">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-[#8A3F35]">
                            Ditujukan Kepada
                        </p>

                        <h3 class="mt-3 text-xl font-black text-[#3C3B39]">
                            {{ $quotation->client_name }}
                        </h3>

                        <p class="mt-2 text-sm text-[#7F756D]">{{ $quotation->company_name ?: '-' }}</p>
                        <p class="mt-1 text-sm text-[#7F756D]">{{ $quotation->email ?: '-' }}</p>
                        <p class="mt-1 text-sm text-[#7F756D]">{{ $quotation->phone ?: '-' }}</p>
                    </div>

                    <div class="rounded-[1.5rem] border border-[#E6D8C8] p-5">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-[#8A3F35]">
                            Status Penawaran
                        </p>

                        <h3 class="mt-3 text-xl font-black text-[#3C3B39]">
                            {{ $quotation->status_label }}
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-[#7F756D]">
                            Penawaran ini dapat dicetak atau disimpan sebagai PDF melalui tombol Print / PDF.
                        </p>
                    </div>
                </div>

                <div class="mt-8 overflow-hidden rounded-[1.5rem] border border-[#E6D8C8]">
                    <table class="quotation-table text-left text-sm">
                        <thead class="bg-[#3C3B39] text-xs font-black uppercase tracking-[0.18em] text-[#FBE9CB]">
                            <tr>
                                <th class="col-item px-5 py-4">Item</th>
                                <th class="col-qty px-5 py-4 text-right">Qty</th>
                                <th class="col-price px-5 py-4 text-right">Harga</th>
                                <th class="col-subtotal px-5 py-4 text-right">Subtotal</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-[#E6D8C8]">
                            @foreach ($quotation->items as $item)
                                <tr class="align-top">
                                    <td class="px-5 py-4">
                                        <p class="font-black text-[#3C3B39]">{{ $item->item_name }}</p>

                                        @if ($item->description)
                                            <p class="mt-1 whitespace-pre-line text-xs leading-6 text-[#7F756D]">
                                                {{ $item->description }}
                                            </p>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4 text-right text-[#7F756D]">
                                        {{ $item->quantity }} {{ $item->unit }}
                                    </td>

                                    <td class="px-5 py-4 text-right text-[#7F756D]">
                                        Rp {{ number_format((float) $item->unit_price, 0, ',', '.') }}
                                    </td>

                                    <td class="px-5 py-4 text-right font-black text-[#3C3B39]">
                                        {{ $item->formatted_subtotal }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-end">
                    <div class="w-full max-w-sm space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-[#7F756D]">Subtotal</span>
                            <span class="font-bold text-[#3C3B39]">
                                Rp {{ number_format((float) $quotation->subtotal, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-[#7F756D]">Diskon</span>
                            <span class="font-bold text-[#3C3B39]">
                                Rp {{ number_format((float) $quotation->discount_amount, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-[#7F756D]">Pajak / Tambahan</span>
                            <span class="font-bold text-[#3C3B39]">
                                Rp {{ number_format((float) $quotation->tax_amount, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="border-t border-[#E6D8C8] pt-3">
                            <div class="flex justify-between text-xl">
                                <span class="font-black text-[#3C3B39]">Total</span>
                                <span class="font-black text-[#3C3B39]">{{ $quotation->formatted_total }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($quotation->notes)
                    <div class="mt-8 rounded-[1.5rem] bg-[#FFF8ED] p-5">
                        <p class="font-black text-[#3C3B39]">Catatan</p>
                        <p class="mt-2 whitespace-pre-line text-sm leading-7 text-[#7F756D]">
                            {{ $quotation->notes }}
                        </p>
                    </div>
                @endif

                @if ($quotation->terms)
                    <div class="mt-6 rounded-[1.5rem] bg-[#FFF8ED] p-5">
                        <p class="font-black text-[#3C3B39]">Syarat & Ketentuan</p>
                        <p class="mt-2 whitespace-pre-line text-sm leading-7 text-[#7F756D]">
                            {{ $quotation->terms }}
                        </p>
                    </div>
                @endif
            </section>

            <section class="no-print mt-6 rounded-[2rem] border border-[#E6D8C8] bg-white p-6 shadow-sm">
                <div class="grid gap-4 sm:grid-cols-2">
                    <form
                        action="{{ route('quotations.preview.approve', [$quotation->quotation_number, $quotation->public_token]) }}"
                        method="POST" onsubmit="return confirm('Setujui penawaran ini?')">
                        @csrf

                        <button
                            class="w-full rounded-2xl bg-emerald-500 px-6 py-4 text-sm font-black text-white transition hover:bg-emerald-600">
                            <i class="fa-solid fa-check mr-2"></i>
                            Setujui & Konfirmasi via WhatsApp
                        </button>
                    </form>

                    <form
                        action="{{ route('quotations.preview.reject', [$quotation->quotation_number, $quotation->public_token]) }}"
                        method="POST" onsubmit="return confirm('Tolak penawaran ini?')">
                        @csrf

                        <button
                            class="w-full rounded-2xl bg-red-100 px-6 py-4 text-sm font-black text-red-700 transition hover:bg-red-200">
                            <i class="fa-solid fa-xmark mr-2"></i>
                            Tolak Penawaran
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </main>
</body>

</html>
