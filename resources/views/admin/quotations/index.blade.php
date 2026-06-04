@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <form method="GET" class="grid gap-3 lg:grid-cols-[1fr_200px_auto]">
            <x-admin.form.input name="search" :value="request('search')" placeholder="Cari nomor, client, brand..." />

            <x-admin.form.select name="status">
                <option value="">Semua Status</option>
                @foreach (\App\Models\Quotation::STATUSES as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </x-admin.form.select>

            <x-admin.button>
                <i class="fa-solid fa-filter"></i>
                Filter
            </x-admin.button>
        </form>

        <x-admin.link-button :href="route('admin.quotations.create')">
            <i class="fa-solid fa-plus"></i>
            Buat Quotation
        </x-admin.link-button>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Penawaran</th>
                        <th class="px-6 py-4">Client</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Valid</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($quotations as $quotation)
                        @php
                            $statusClass = match ($quotation->status) {
                                'draft' => 'bg-stone-100 text-stone-600',
                                'sent' => 'bg-blue-100 text-blue-700',
                                'approved' => 'bg-emerald-100 text-emerald-700',
                                'rejected' => 'bg-red-100 text-red-700',
                                'expired' => 'bg-amber-100 text-amber-800',
                                default => 'bg-stone-100 text-stone-600',
                            };
                        @endphp

                        <tr class="align-top">
                            <td class="px-6 py-5">
                                <h3 class="font-black text-stone-950">{{ $quotation->quotation_number }}</h3>
                                <p class="mt-1 text-sm font-semibold text-stone-600">{{ $quotation->title ?: '-' }}</p>
                                <p class="mt-1 text-xs text-stone-500">{{ $quotation->items_count }} item</p>
                            </td>

                            <td class="px-6 py-5">
                                <p class="font-black text-stone-800">{{ $quotation->client_name }}</p>
                                <p class="mt-1 text-xs text-stone-500">{{ $quotation->company_name ?: '-' }}</p>
                                <p class="mt-1 text-xs text-stone-500">{{ $quotation->phone ?: '-' }}</p>
                            </td>

                            <td class="px-6 py-5 font-black text-stone-950">
                                {{ $quotation->formatted_total }}
                            </td>

                            <td class="px-6 py-5">
                                <span class="rounded-full px-3 py-1 text-xs font-black {{ $statusClass }}">
                                    {{ $quotation->status_label }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-stone-600">
                                {{ $quotation->valid_until?->format('d M Y') ?: '-' }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <x-admin.link-button :href="route('admin.quotations.show', $quotation)" variant="light" class="px-4 py-2 text-xs">
                                        Detail
                                    </x-admin.link-button>

                                    <x-admin.link-button :href="route('admin.quotations.edit', $quotation)" variant="light" class="px-4 py-2 text-xs">
                                        Edit
                                    </x-admin.link-button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-stone-500">
                                Belum ada quotation.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-stone-200 px-6 py-4">
            {{ $quotations->links() }}
        </div>
    </div>
@endsection
