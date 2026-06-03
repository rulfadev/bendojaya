@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <form method="GET" class="grid gap-3 sm:grid-cols-[1fr_180px_auto]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, username, email..."
                class="rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold outline-none focus:border-stone-950">

            <select name="role"
                class="rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold outline-none focus:border-stone-950">
                <option value="">Semua Role</option>
                @foreach (\App\Models\User::ROLES as $value => $label)
                    <option value="{{ $value }}" @selected(request('role') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <button class="rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200">
                Filter
            </button>
        </form>

        <a href="{{ route('admin.users.create') }}"
            class="inline-flex justify-center rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200">
            Tambah User
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Dibuat</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($users as $item)
                        <tr>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-950 text-sm font-black text-amber-200">
                                        {{ strtoupper(mb_substr($item->name ?? 'U', 0, 1)) }}
                                    </div>

                                    <div>
                                        <h3 class="font-black text-stone-950">
                                            {{ $item->name }}
                                            @if (auth()->id() === $item->id)
                                                <span
                                                    class="ml-2 rounded-full bg-amber-100 px-2 py-1 text-[10px] font-black text-amber-800">Anda</span>
                                            @endif
                                        </h3>
                                        <p class="mt-1 text-xs font-semibold text-stone-500">{{ '@' . $item->username }}</p>
                                        <p class="mt-1 text-xs font-semibold text-stone-500">{{ $item->email }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5 font-bold text-stone-700">
                                {{ \App\Models\User::ROLES[$item->role] ?? ucfirst($item->role) }}
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $item->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-stone-600">
                                {{ $item->created_at?->format('d M Y') }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $item) }}"
                                        class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700">
                                        Edit
                                    </a>

                                    @if (auth()->id() !== $item->id)
                                        <form action="{{ route('admin.users.destroy', $item) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus user ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="rounded-xl bg-red-100 px-4 py-2 text-xs font-black text-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-stone-500">
                                Belum ada user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-stone-200 px-6 py-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
