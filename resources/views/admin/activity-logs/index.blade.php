@extends('layouts.admin')

@section('content')
    <section class="admin-filter-card mb-8 rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-5 shadow-sm">
        <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Filter Log
                </p>
                <h3 class="mt-1 text-lg font-black text-stone-950">
                    Cari aktivitas berdasarkan aksi, user, dan modul.
                </h3>
            </div>

            <form action="{{ route('admin.activity-logs.clear-old') }}" method="POST" data-confirm-delete
                data-confirm-message="Hapus activity log lebih dari 90 hari?">

                @csrf
                @method('DELETE')

                <x-admin.button variant="danger" type="submit" class="w-full sm:w-auto">
                    <i class="fa-solid fa-trash"></i>
                    Hapus Log Lama
                </x-admin.button>
            </form>
        </div>

        <form method="GET" class="grid gap-3 lg:grid-cols-[1.4fr_0.8fr_0.9fr_0.9fr_auto] lg:items-end">
            <x-admin.form.input name="search" :value="request('search')" placeholder="Cari deskripsi, URL, IP..."
                class="py-3 font-semibold" />

            <x-admin.form.select name="action">
                <option value="">Semua Aksi</option>
                @foreach (\App\Models\ActivityLog::ACTIONS as $value => $label)
                    <option value="{{ $value }}" @selected(request('action') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </x-admin.form.select>

            <x-admin.form.select name="user_id">
                <option value="">Semua User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected((int) request('user_id') === $user->id)>
                        {{ $user->name }}
                    </option>
                @endforeach
            </x-admin.form.select>

            <x-admin.form.select name="subject_type">
                <option value="">Semua Modul</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject }}" @selected(request('subject_type') === $subject)>
                        {{ class_basename($subject) }}
                    </option>
                @endforeach
            </x-admin.form.select>

            <x-admin.button class="h-full w-full px-6">
                <i class="fa-solid fa-filter"></i>
                Filter
            </x-admin.button>
        </form>
    </section>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1100px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Aktivitas</th>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Modul</th>
                        <th class="px-6 py-4">IP</th>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($logs as $log)
                        @php
                            $badgeClass = match ($log->action) {
                                'created' => 'bg-emerald-100 text-emerald-700',
                                'updated' => 'bg-blue-100 text-blue-700',
                                'deleted' => 'bg-red-100 text-red-700',
                                'login' => 'bg-amber-100 text-amber-800',
                                'logout' => 'bg-stone-100 text-stone-600',
                                default => 'bg-stone-100 text-stone-600',
                            };
                        @endphp

                        <tr class="align-top">
                            <td class="px-6 py-5">
                                <span class="rounded-full px-3 py-1 text-xs font-black {{ $badgeClass }}">
                                    {{ $log->action_label }}
                                </span>

                                <p class="mt-3 font-black text-stone-950">
                                    {{ $log->description ?: '-' }}
                                </p>

                                <p class="mt-1 max-w-xl truncate text-xs font-semibold text-stone-500">
                                    {{ $log->method }} {{ $log->url }}
                                </p>
                            </td>

                            <td class="px-6 py-5">
                                <p class="font-black text-stone-800">
                                    {{ $log->user?->name ?: 'System' }}
                                </p>

                                <p class="mt-1 text-xs font-semibold text-stone-500">
                                    {{ $log->user?->email ?: '-' }}
                                </p>
                            </td>

                            <td class="px-6 py-5 font-bold text-stone-700">
                                {{ $log->subject_name }}
                            </td>

                            <td class="px-6 py-5 text-stone-600">
                                {{ $log->ip_address ?: '-' }}
                            </td>

                            <td class="px-6 py-5 text-stone-600">
                                {{ $log->created_at?->format('d M Y H:i') }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <x-admin.link-button :href="route('admin.activity-logs.show', $log)" variant="light" class="px-4 py-2 text-xs">
                                        Detail
                                    </x-admin.link-button>

                                    <form action="{{ route('admin.activity-logs.destroy', $log) }}" method="POST"
                                        data-confirm-delete data-confirm-message="Activity log ini akan dihapus permanen.">
                                        @csrf
                                        @method('DELETE')

                                        <x-admin.button variant="danger" class="px-4 py-2 text-xs">
                                            Hapus
                                        </x-admin.button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-stone-500">
                                Belum ada activity log.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-stone-200 px-6 py-4">
            {{ $logs->links() }}
        </div>
    </div>
@endsection
