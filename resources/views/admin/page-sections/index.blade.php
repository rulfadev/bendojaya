@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-stone-500">
                Halaman:
                <a href="{{ route('pages.show', $page) }}" target="_blank" class="font-black text-amber-800">
                    {{ $page->title }}
                </a>
            </p>
            <p class="mt-1 text-xs font-semibold text-stone-400">
                /pages/{{ $page->slug }}
            </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('admin.pages.index') }}"
                class="inline-flex justify-center rounded-2xl border border-stone-200 bg-white px-5 py-3 text-sm font-black text-stone-700 transition hover:border-stone-950 hover:text-stone-950">
                Kembali
            </a>

            <a href="{{ route('admin.pages.sections.create', $page) }}"
                class="inline-flex justify-center rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200 transition hover:bg-stone-800">
                Tambah Section
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Section</th>
                        <th class="px-6 py-4">Tipe</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Urutan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($sections as $section)
                        <tr class="align-top">
                            <td class="px-6 py-5">
                                <div class="flex gap-4">
                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-stone-950 text-sm font-black text-amber-200">
                                        @if ($section->image)
                                            <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->title }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                        @endif
                                    </div>

                                    <div>
                                        <h3 class="font-black text-stone-950">
                                            {{ $section->title ?: 'Tanpa Judul' }}
                                        </h3>

                                        @if ($section->eyebrow)
                                            <p class="mt-1 text-xs font-black uppercase tracking-[0.18em] text-amber-800">
                                                {{ $section->eyebrow }}
                                            </p>
                                        @endif

                                        @if ($section->subtitle)
                                            <p class="mt-2 max-w-xl leading-6 text-stone-500">
                                                {{ $section->subtitle }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-black text-amber-800">
                                    {{ \App\Models\PageSection::TYPES[$section->type] ?? $section->type }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $section->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $section->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 font-bold text-stone-600">
                                {{ $section->sort_order }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.pages.sections.edit', [$page, $section]) }}"
                                        class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700 transition hover:border-stone-950 hover:text-stone-950">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.pages.sections.destroy', [$page, $section]) }}"
                                        method="POST" onsubmit="return confirm('Yakin ingin menghapus section ini?')">
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
                                Belum ada section untuk halaman ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($sections->hasPages())
            <div class="border-t border-stone-200 px-6 py-4">
                {{ $sections->links() }}
            </div>
        @endif
    </div>
@endsection
