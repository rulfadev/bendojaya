@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between">
        <p class="text-sm font-semibold text-stone-500">Total menu: {{ $menus->total() }}</p>

        <a href="{{ route('admin.navigation-menus.create') }}"
            class="rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200">
            Tambah Menu
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Label</th>
                        <th class="px-6 py-4">Tipe</th>
                        <th class="px-6 py-4">URL</th>
                        <th class="px-6 py-4">Posisi</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Urutan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($menus as $menu)
                        <tr>
                            <td class="px-6 py-5 font-black text-stone-950">{{ $menu->label }}</td>
                            <td class="px-6 py-5">{{ \App\Models\NavigationMenu::TYPES[$menu->type] ?? $menu->type }}</td>
                            <td class="px-6 py-5">
                                <a href="{{ $menu->href }}" target="_blank" class="text-xs font-semibold text-amber-800">
                                    {{ $menu->href }}
                                </a>
                            </td>
                            <td class="px-6 py-5">
                                {{ \App\Models\NavigationMenu::POSITIONS[$menu->position] ?? $menu->position }}</td>
                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $menu->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-5 font-bold">{{ $menu->sort_order }}</td>
                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.navigation-menus.edit', $menu) }}"
                                        class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.navigation-menus.destroy', $menu) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus menu ini?')">
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
                            <td colspan="7" class="px-6 py-12 text-center text-stone-500">
                                Belum ada menu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-stone-200 px-6 py-4">
            {{ $menus->links() }}
        </div>
    </div>
@endsection
