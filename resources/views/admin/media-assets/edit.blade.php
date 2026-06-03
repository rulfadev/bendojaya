@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.media-assets.update', $asset) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid gap-8 xl:grid-cols-3">
            <div class="space-y-8 xl:col-span-2">
                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <img src="{{ $asset->url }}" alt="{{ $asset->alt_text ?: $asset->title }}"
                        class="max-h-[620px] w-full rounded-[2rem] object-contain bg-white p-3">
                </section>
            </div>

            <div class="space-y-8">
                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <x-admin.form.input name="title" label="Judul" :value="$asset->title" />

                    <div class="mt-5">
                        <x-admin.form.input name="alt_text" label="Alt Text" :value="$asset->alt_text" />
                    </div>

                    <div class="mt-5">
                        <x-admin.form.input name="folder" label="Folder" :value="$asset->folder" />
                    </div>

                    <div class="mt-5">
                        <label class="mb-2 block text-sm font-black text-stone-800">URL</label>
                        <input type="text" readonly value="{{ $asset->url }}"
                            onclick="this.select(); navigator.clipboard.writeText(this.value);"
                            class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-600">
                    </div>
                </section>

                <x-admin.button class="w-full">
                    <i class="fa-solid fa-save"></i>
                    Simpan Media
                </x-admin.button>

                <x-admin.link-button :href="route('admin.media-assets.index')" variant="light" class="w-full">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </x-admin.link-button>
            </div>
        </div>
    </form>
@endsection
