@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between">
        <p class="text-sm font-semibold text-stone-500">Total partner: {{ $partners->total() }}</p>

        <a href="{{ route('admin.partners.create') }}"
            class="rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200">
            Tambah Partner
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Partner</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Featured</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Urutan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($partners as $partner)
                        <tr>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="flex h-14 w-14 items-center justify-center overflow-hidden rounded-2xl bg-stone-950 text-xs font-black text-amber-200">
                                        @if ($partner->logo)
                                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            BJ
                                        @endif
                                    </div>

                                    <div>
                                        <h3 class="font-black text-stone-950">{{ $partner->name }}</h3>
                                        <p class="mt-1 text-xs font-semibold text-amber-800">{{ $partner->slug }}</p>
                                        <p class="mt-2 max-w-lg leading-6 text-stone-500">{{ $partner->description }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5">{{ $partner->category ?: '-' }}</td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $partner->is_featured ? 'bg-amber-100 text-amber-800' : 'bg-stone-100 text-stone-500' }}">
                                    {{ $partner->is_featured ? 'Ya' : 'Tidak' }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $partner->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $partner->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 font-bold">{{ $partner->sort_order }}</td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.partners.edit', $partner) }}"
                                        class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                        data-confirm-delete data-confirm-message="Partner ini akan dihapus permanen.">
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
                            <td colspan="6" class="px-6 py-12 text-center text-stone-500">
                                Belum ada partner.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-stone-200 px-6 py-4">
            {{ $partners->links() }}
        </div>
    </div>
@endsection
