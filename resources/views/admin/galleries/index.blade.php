@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between">
        <p class="text-sm font-semibold text-stone-500">Total gallery: {{ $galleries->total() }}</p>

        <a href="{{ route('admin.galleries.create') }}"
            class="rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200">
            Tambah Gallery
        </a>
    </div>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($galleries as $gallery)
            <article class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
                <div class="h-72 overflow-hidden bg-stone-200">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                        class="h-full w-full object-cover">
                </div>

                <div class="p-6">
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-amber-700">
                        {{ $gallery->category ?: 'Gallery' }}
                    </p>

                    <h3 class="mt-2 text-xl font-black text-stone-950">{{ $gallery->title }}</h3>

                    <p class="mt-3 text-sm leading-6 text-stone-500">
                        {{ $gallery->caption }}
                    </p>

                    <div class="mt-5 flex items-center justify-between">
                        <div class="flex gap-2">
                            <span
                                class="rounded-full px-3 py-1 text-xs font-black {{ $gallery->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>

                            <span
                                class="rounded-full px-3 py-1 text-xs font-black {{ $gallery->is_featured ? 'bg-amber-100 text-amber-800' : 'bg-stone-100 text-stone-500' }}">
                                {{ $gallery->is_featured ? 'Featured' : 'Biasa' }}
                            </span>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('admin.galleries.edit', $gallery) }}"
                                class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700">
                                Edit
                            </a>

                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST"
                                data-confirm-delete data-confirm-message="Gallery ini akan dihapus permanen.">
                                @csrf
                                @method('DELETE')

                                <button class="rounded-xl bg-red-100 px-4 py-2 text-xs font-black text-red-700">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div
                class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-10 text-center text-stone-500 md:col-span-2 xl:col-span-3">
                Belum ada gallery.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $galleries->links() }}
    </div>
@endsection
