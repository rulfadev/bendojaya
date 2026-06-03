@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.media-assets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid gap-8 xl:grid-cols-3">
            <div class="space-y-8 xl:col-span-2">
                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <div class="grid gap-5">
                        <x-admin.form.file name="files[]" label="Pilih Gambar" accept=".jpg,.jpeg,.png,.webp,.svg" multiple />

                        <p class="text-sm font-semibold leading-7 text-stone-500">
                            Bisa upload lebih dari satu gambar. Maksimal 4MB per file.
                        </p>
                    </div>
                </section>
            </div>

            <div class="space-y-8">
                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <x-admin.form.input name="folder" label="Folder" placeholder="hero / artikel / koleksi / gallery" />

                    <div class="mt-5">
                        <x-admin.form.input name="alt_text" label="Alt Text Default"
                            placeholder="Deskripsi singkat gambar" />
                    </div>
                </section>

                <x-admin.button class="w-full">
                    <i class="fa-solid fa-upload"></i>
                    Upload Media
                </x-admin.button>
            </div>
        </div>
    </form>
@endsection
