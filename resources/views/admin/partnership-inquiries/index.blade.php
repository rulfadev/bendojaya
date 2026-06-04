@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <form method="GET" class="grid gap-3 lg:grid-cols-[1fr_200px_200px_auto]">
            <x-admin.form.input name="search" :value="request('search')" placeholder="Cari brand, PIC, WA, email..." />

            <x-admin.form.select name="partnership_type">
                <option value="">Semua Jenis</option>
                @foreach (\App\Models\PartnershipInquiry::PARTNERSHIP_TYPES as $value => $label)
                    <option value="{{ $value }}" @selected(request('partnership_type') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </x-admin.form.select>

            <x-admin.form.select name="status">
                <option value="">Semua Status</option>
                @foreach (\App\Models\PartnershipInquiry::STATUSES as $value => $label)
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
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1050px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Partner</th>
                        <th class="px-6 py-4">Jenis</th>
                        <th class="px-6 py-4">Estimasi</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($inquiries as $inquiry)
                        @php
                            $statusClass = match ($inquiry->status) {
                                'new' => 'bg-amber-100 text-amber-800',
                                'contacted' => 'bg-blue-100 text-blue-700',
                                'completed' => 'bg-emerald-100 text-emerald-700',
                                'archived' => 'bg-stone-100 text-stone-500',
                                default => 'bg-stone-100 text-stone-500',
                            };
                        @endphp

                        <tr class="align-top">
                            <td class="px-6 py-5">
                                <h3 class="font-black text-stone-950">{{ $inquiry->company_name ?: '-' }}</h3>
                                <p class="mt-1 text-xs font-semibold text-stone-500">PIC: {{ $inquiry->pic_name }}</p>
                                <p class="mt-1 text-xs font-semibold text-stone-500">{{ $inquiry->phone }}</p>
                                <p class="mt-1 text-xs font-semibold text-stone-500">{{ $inquiry->email ?: '-' }}</p>
                            </td>

                            <td class="px-6 py-5 font-bold text-stone-800">
                                {{ $inquiry->partnership_type_label }}
                            </td>

                            <td class="px-6 py-5">
                                <p class="text-stone-700">Jumlah: {{ $inquiry->estimated_quantity ?: '-' }}</p>
                                <p class="mt-1 text-xs text-stone-500">Budget: {{ $inquiry->budget_range ?: '-' }}</p>
                                <p class="mt-1 text-xs text-stone-500">Deadline:
                                    {{ $inquiry->deadline_date?->format('d M Y') ?: '-' }}</p>
                            </td>

                            <td class="px-6 py-5">
                                <span class="rounded-full px-3 py-1 text-xs font-black {{ $statusClass }}">
                                    {{ $inquiry->status_label }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-stone-600">
                                {{ $inquiry->created_at?->format('d M Y H:i') }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <x-admin.link-button :href="route('admin.partnership-inquiries.show', $inquiry)" variant="light" class="px-4 py-2 text-xs">
                                        Detail
                                    </x-admin.link-button>

                                    <a href="{{ $inquiry->whatsapp_url }}" target="_blank"
                                        class="inline-flex items-center justify-center rounded-xl bg-emerald-100 px-4 py-2 text-xs font-black text-emerald-700">
                                        WA
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-stone-500">
                                Belum ada inquiry kerja sama.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-stone-200 px-6 py-4">
            {{ $inquiries->links() }}
        </div>
    </div>
@endsection
