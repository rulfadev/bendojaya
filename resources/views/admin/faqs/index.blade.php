@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm font-semibold text-stone-500">
            Total FAQ: {{ $faqs->total() }}
        </p>

        <a href="{{ route('admin.faqs.create') }}"
            class="rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200">
            Tambah FAQ
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Pertanyaan</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Featured</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Urutan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($faqs as $faq)
                        <tr class="align-top">
                            <td class="px-6 py-5">
                                <h3 class="font-black text-stone-950">{{ $faq->question }}</h3>
                                <p class="mt-2 max-w-2xl text-sm leading-6 text-stone-500">
                                    {{ str($faq->answer)->limit(160) }}
                                </p>
                            </td>

                            <td class="px-6 py-5">{{ $faq->category ?: '-' }}</td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $faq->is_featured ? 'bg-amber-100 text-amber-800' : 'bg-stone-100 text-stone-500' }}">
                                    {{ $faq->is_featured ? 'Ya' : 'Tidak' }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $faq->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 font-bold">{{ $faq->sort_order }}</td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}"
                                        class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus FAQ ini?')">
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
                                Belum ada FAQ.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-stone-200 px-6 py-4">
            {{ $faqs->links() }}
        </div>
    </div>
@endsection
