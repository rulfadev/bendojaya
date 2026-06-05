@extends('layouts.admin')

@section('content')
    <div class="grid gap-6 xl:grid-cols-2">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="mb-5 flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                        Inquiry Koleksi
                    </p>
                    <h3 class="mt-2 text-xl font-black text-stone-950">
                        Inquiry koleksi baru
                    </h3>
                </div>

                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-black text-amber-800">
                    {{ $collectionInquiries->count() }}
                </span>
            </div>

            <div class="space-y-3">
                @forelse ($collectionInquiries as $inquiry)
                    <a href="{{ route('admin.collection-inquiries.show', $inquiry) }}"
                        class="block rounded-2xl border border-stone-200 bg-white p-4 transition hover:-translate-y-0.5 hover:shadow-sm">
                        <p class="font-black text-stone-950">{{ $inquiry->name }}</p>
                        <p class="mt-1 text-sm font-semibold text-stone-500">
                            {{ $inquiry->collection?->name ?: 'Koleksi Bendo Jaya' }}
                        </p>
                        <p class="mt-2 text-xs text-stone-400">
                            {{ $inquiry->created_at?->format('d M Y H:i') }}
                        </p>
                    </a>
                @empty
                    <div class="rounded-2xl border border-stone-200 bg-white p-5 text-sm font-semibold text-stone-500">
                        Tidak ada inquiry koleksi baru.
                    </div>
                @endforelse
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="mb-5 flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                        Inquiry Kerja Sama
                    </p>
                    <h3 class="mt-2 text-xl font-black text-stone-950">
                        Proposal kerja sama baru
                    </h3>
                </div>

                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-black text-amber-800">
                    {{ $partnershipInquiries->count() }}
                </span>
            </div>

            <div class="space-y-3">
                @forelse ($partnershipInquiries as $inquiry)
                    <a href="{{ route('admin.partnership-inquiries.show', $inquiry) }}"
                        class="block rounded-2xl border border-stone-200 bg-white p-4 transition hover:-translate-y-0.5 hover:shadow-sm">
                        <p class="font-black text-stone-950">
                            {{ $inquiry->company_name ?: 'Kerja Sama Bendo Jaya' }}
                        </p>
                        <p class="mt-1 text-sm font-semibold text-stone-500">
                            PIC: {{ $inquiry->pic_name }}
                        </p>
                        <p class="mt-2 text-xs text-stone-400">
                            {{ $inquiry->created_at?->format('d M Y H:i') }}
                        </p>
                    </a>
                @empty
                    <div class="rounded-2xl border border-stone-200 bg-white p-5 text-sm font-semibold text-stone-500">
                        Tidak ada inquiry kerja sama baru.
                    </div>
                @endforelse
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="mb-5">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-emerald-700">
                    Quotation Approved
                </p>
                <h3 class="mt-2 text-xl font-black text-stone-950">
                    Penawaran disetujui client
                </h3>
            </div>

            <div class="space-y-3">
                @forelse ($approvedQuotations as $quotation)
                    <a href="{{ route('admin.quotations.show', $quotation) }}"
                        class="block rounded-2xl border border-emerald-200 bg-emerald-50 p-4 transition hover:-translate-y-0.5 hover:shadow-sm">
                        <p class="font-black text-stone-950">{{ $quotation->quotation_number }}</p>
                        <p class="mt-1 text-sm font-semibold text-stone-600">
                            {{ $quotation->client_name }} · {{ $quotation->formatted_total }}
                        </p>
                        <p class="mt-2 text-xs text-emerald-700">
                            Disetujui:
                            {{ $quotation->client_responded_at?->format('d M Y H:i') ?? $quotation->approved_at?->format('d M Y H:i') }}
                        </p>
                    </a>
                @empty
                    <div class="rounded-2xl border border-stone-200 bg-white p-5 text-sm font-semibold text-stone-500">
                        Belum ada quotation disetujui.
                    </div>
                @endforelse
            </div>
        </section>

        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="mb-5">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-blue-700">
                    Quotation Viewed
                </p>
                <h3 class="mt-2 text-xl font-black text-stone-950">
                    Penawaran sudah dilihat client
                </h3>
            </div>

            <div class="space-y-3">
                @forelse ($viewedQuotations as $quotation)
                    <a href="{{ route('admin.quotations.show', $quotation) }}"
                        class="block rounded-2xl border border-blue-200 bg-blue-50 p-4 transition hover:-translate-y-0.5 hover:shadow-sm">
                        <p class="font-black text-stone-950">{{ $quotation->quotation_number }}</p>
                        <p class="mt-1 text-sm font-semibold text-stone-600">
                            {{ $quotation->client_name }} · {{ $quotation->formatted_total }}
                        </p>
                        <p class="mt-2 text-xs text-blue-700">
                            Dilihat: {{ $quotation->viewed_at?->format('d M Y H:i') }}
                        </p>
                    </a>
                @empty
                    <div class="rounded-2xl border border-stone-200 bg-white p-5 text-sm font-semibold text-stone-500">
                        Belum ada quotation yang dilihat client.
                    </div>
                @endforelse
            </div>
        </section>
    </div>

    <section class="mt-6 rounded-[2rem] border border-red-200 bg-red-50 p-6">
        <div class="mb-5">
            <p class="text-xs font-black uppercase tracking-[0.25em] text-red-700">
                Quotation Rejected
            </p>
            <h3 class="mt-2 text-xl font-black text-stone-950">
                Penawaran ditolak client
            </h3>
        </div>

        <div class="grid gap-3 md:grid-cols-2">
            @forelse ($rejectedQuotations as $quotation)
                <a href="{{ route('admin.quotations.show', $quotation) }}"
                    class="block rounded-2xl border border-red-200 bg-white p-4 transition hover:-translate-y-0.5 hover:shadow-sm">
                    <p class="font-black text-stone-950">{{ $quotation->quotation_number }}</p>
                    <p class="mt-1 text-sm font-semibold text-stone-600">
                        {{ $quotation->client_name }} · {{ $quotation->formatted_total }}
                    </p>
                    <p class="mt-2 text-xs text-red-700">
                        Ditolak:
                        {{ $quotation->client_responded_at?->format('d M Y H:i') ?? $quotation->rejected_at?->format('d M Y H:i') }}
                    </p>
                </a>
            @empty
                <div
                    class="rounded-2xl border border-red-200 bg-white p-5 text-sm font-semibold text-stone-500 md:col-span-2">
                    Belum ada quotation ditolak.
                </div>
            @endforelse
        </div>
    </section>
@endsection
