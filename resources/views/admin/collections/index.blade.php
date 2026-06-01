@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm font-semibold text-stone-500">
            Total koleksi: {{ $collections->total() }}
        </p>

        <a href="{{ route('admin.collections.create') }}"
            class="inline-flex justify-center rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200 transition hover:bg-stone-800">
            Tambah Koleksi
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Koleksi</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Featured</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Urutan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($collections as $collection)
                        <tr class="align-top">
                            <td class="px-6 py-5">
                                <div class="flex gap-4">
                                    <div class="h-20 w-16 shrink-0 overflow-hidden rounded-2xl bg-stone-200">
                                        @if ($collection->main_image)
                                            <img src="{{ asset('storage/' . $collection->main_image) }}"
                                                alt="{{ $collection->name }}" class="h-full w-full object-cover">
                                        @else
                                            <div
                                                class="flex h-full w-full items-center justify-center bg-stone-950 text-xs font-black text-amber-200">
                                                BJ
                                            </div>
                                        @endif
                                    </div>

                                    <div>
                                        <h3 class="font-black text-stone-950">{{ $collection->name }}</h3>
                                        <p class="mt-1 text-xs font-semibold text-amber-800">{{ $collection->slug }}</p>
                                        <p class="mt-2 max-w-xl leading-6 text-stone-500">
                                            {{ $collection->short_description }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <span class="rounded-full bg-stone-100 px-3 py-1 text-xs font-black text-stone-600">
                                    {{ $collection->category ?: '-' }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $collection->is_featured ? 'bg-amber-100 text-amber-800' : 'bg-stone-100 text-stone-500' }}">
                                    {{ $collection->is_featured ? 'Ya' : 'Tidak' }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $collection->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $collection->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 font-bold text-stone-600">
                                {{ $collection->sort_order }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.collections.edit', $collection) }}"
                                        class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700 transition hover:border-stone-950 hover:text-stone-950">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.collections.destroy', $collection) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus koleksi ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-xl bg-red-100 px-4 py-2 text-xs font-black text-red-700 transition hover:bg-red-200">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-stone-500">
                                Belum ada koleksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($collections->hasPages())
            <div class="border-t border-stone-200 px-6 py-4">
                {{ $collections->links() }}
            </div>
        @endif
    </div>
@endsection
