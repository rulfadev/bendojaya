@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm font-semibold text-stone-500">Total halaman: {{ $pages->total() }}</p>

        <a href="{{ route('admin.pages.create') }}"
            class="inline-flex justify-center rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200 transition hover:bg-stone-800">
            Tambah Halaman
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Halaman</th>
                        <th class="px-6 py-4">Navigasi</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Urutan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($pages as $page)
                        <tr>
                            <td class="px-6 py-5">
                                <h3 class="font-black text-stone-950">{{ $page->title }}</h3>
                                <a href="{{ route('pages.show', $page) }}" target="_blank"
                                    class="mt-1 inline-flex text-xs font-semibold text-amber-800">
                                    /pages/{{ $page->slug }}
                                </a>
                                <p class="mt-2 max-w-xl leading-6 text-stone-500">{{ $page->excerpt }}</p>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $page->show_in_navigation ? 'bg-amber-100 text-amber-800' : 'bg-stone-100 text-stone-500' }}">
                                    {{ $page->show_in_navigation ? 'Tampil' : 'Tidak' }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $page->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $page->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 font-bold text-stone-600">
                                {{ $page->sort_order }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.pages.edit', $page) }}"
                                        class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700 transition hover:border-stone-950 hover:text-stone-950">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus halaman ini?')">
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
                            <td colspan="5" class="px-6 py-12 text-center text-stone-500">
                                Belum ada custom page.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pages->hasPages())
            <div class="border-t border-stone-200 px-6 py-4">
                {{ $pages->links() }}
            </div>
        @endif
    </div>
@endsection
