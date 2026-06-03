@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <form method="GET" class="grid gap-3 sm:grid-cols-[1fr_180px_auto]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari media..."
                class="rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold outline-none focus:border-stone-950">

            <x-admin.form.select name="folder">
                <option value="">Semua Folder</option>

                @foreach ($folders as $folder)
                    <option value="{{ $folder }}" @selected(request('folder') === $folder)>
                        {{ $folder }}
                    </option>
                @endforeach
            </x-admin.form.select>

            <button class="rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200">
                Filter
            </button>
        </form>

        <x-admin.link-button :href="route('admin.media-assets.create')">
            <i class="fa-solid fa-upload"></i>
            Upload Media
        </x-admin.link-button>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
        @forelse ($assets as $asset)
            <article class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-3 shadow-sm">
                <div class="overflow-hidden rounded-[1.5rem] bg-white">
                    @if ($asset->isImage())
                        <img src="{{ $asset->url }}" alt="{{ $asset->alt_text ?: $asset->title }}"
                            class="h-64 w-full object-cover">
                    @else
                        <div class="flex h-64 items-center justify-center text-stone-400">
                            <i class="fa-solid fa-file text-4xl"></i>
                        </div>
                    @endif
                </div>

                <div class="p-4">
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-amber-700">
                        {{ $asset->folder ?: 'general' }}
                    </p>

                    <h3 class="mt-2 truncate font-black text-stone-950">
                        {{ $asset->title ?: $asset->original_name }}
                    </h3>

                    <p class="mt-1 text-xs font-semibold text-stone-500">
                        {{ $asset->mime_type }} · {{ $asset->human_size }}
                    </p>

                    <input type="text" readonly value="{{ $asset->url }}"
                        onclick="this.select(); navigator.clipboard.writeText(this.value);"
                        class="mt-4 w-full rounded-xl border border-stone-200 bg-white px-3 py-2 text-xs font-semibold text-stone-600">

                    <div class="mt-4 flex gap-2">
                        <x-admin.link-button :href="route('admin.media-assets.edit', $asset)" variant="light" class="flex-1 px-4 py-2 text-xs">
                            Edit
                        </x-admin.link-button>

                        <form action="{{ route('admin.media-assets.destroy', $asset) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Yakin hapus media ini?')">
                            @csrf
                            @method('DELETE')

                            <x-admin.button variant="danger" class="w-full px-4 py-2 text-xs">
                                Hapus
                            </x-admin.button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div
                class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-10 text-center text-stone-500 sm:col-span-2 lg:col-span-3 2xl:col-span-4">
                Belum ada media.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $assets->links() }}
    </div>
@endsection
