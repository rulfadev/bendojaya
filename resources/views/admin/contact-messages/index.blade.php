@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <p class="text-sm font-semibold text-stone-500">
            Total pesan: {{ $messages->total() }}
        </p>

        <form method="GET" class="flex gap-3">
            <select name="status"
                class="rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none">
                <option value="">Semua Status</option>
                @foreach (\App\Models\ContactMessage::STATUSES as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <button class="rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200">
                Filter
            </button>
        </form>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Pengirim</th>
                        <th class="px-6 py-4">Subjek</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($messages as $message)
                        <tr class="align-top {{ $message->is_read ? '' : 'bg-amber-50/60' }}">
                            <td class="px-6 py-5">
                                <h3 class="font-black text-stone-950">{{ $message->name }}</h3>
                                <p class="mt-1 text-xs font-semibold text-stone-500">{{ $message->email ?: '-' }}</p>
                                <p class="mt-1 text-xs font-semibold text-stone-500">{{ $message->phone ?: '-' }}</p>
                            </td>

                            <td class="px-6 py-5">
                                <p class="font-bold text-stone-800">{{ $message->subject ?: 'Tanpa subjek' }}</p>
                                <p class="mt-2 max-w-xl text-sm leading-6 text-stone-500">
                                    {{ str($message->message)->limit(140) }}
                                </p>
                            </td>

                            <td class="px-6 py-5">
                                @php
                                    $statusClass = match ($message->status) {
                                        'new' => 'bg-amber-100 text-amber-800',
                                        'read' => 'bg-blue-100 text-blue-700',
                                        'contacted' => 'bg-purple-100 text-purple-700',
                                        'completed' => 'bg-emerald-100 text-emerald-700',
                                        'archived' => 'bg-stone-100 text-stone-500',
                                        default => 'bg-stone-100 text-stone-500',
                                    };
                                @endphp

                                <span class="rounded-full px-3 py-1 text-xs font-black {{ $statusClass }}">
                                    {{ \App\Models\ContactMessage::STATUSES[$message->status] ?? 'Baru' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-stone-600">
                                {{ $message->created_at->format('d M Y H:i') }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.contact-messages.show', $message) }}"
                                        class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700">
                                        Detail
                                    </a>

                                    <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="rounded-xl bg-red-100 px-4 py-2 text-xs font-black text-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-stone-500">
                                Belum ada pesan kontak.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-stone-200 px-6 py-4">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
