@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-stone-500">Total layanan: {{ $services->total() }}</p>
        </div>

        <a href="{{ route('admin.services.create') }}"
            class="inline-flex justify-center rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200 transition hover:bg-stone-800">
            Tambah Layanan
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Layanan</th>
                        <th class="px-6 py-4">Featured</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Urutan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200">
                    @forelse ($services as $service)
                        <tr class="align-top">
                            <td class="px-6 py-5">
                                <div class="flex gap-4">
                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-stone-950 text-sm font-black text-amber-200">
                                        @if ($service->image)
                                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            {{ $service->icon ?: str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                        @endif
                                    </div>

                                    <div>
                                        <h3 class="font-black text-stone-950">{{ $service->title }}</h3>
                                        <p class="mt-1 text-xs font-semibold text-amber-800">{{ $service->slug }}</p>
                                        <p class="mt-2 max-w-xl leading-6 text-stone-500">{{ $service->short_description }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $service->is_featured ? 'bg-amber-100 text-amber-800' : 'bg-stone-100 text-stone-500' }}">
                                    {{ $service->is_featured ? 'Ya' : 'Tidak' }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $service->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 font-bold text-stone-600">
                                {{ $service->sort_order }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.services.edit', $service) }}"
                                        class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700 transition hover:border-stone-950 hover:text-stone-950">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                        data-confirm-delete data-confirm-message="Layanan ini akan dihapus permanen.">
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
                                Belum ada layanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($services->hasPages())
            <div class="border-t border-stone-200 px-6 py-4">
                {{ $services->links() }}
            </div>
        @endif
    </div>
@endsection
