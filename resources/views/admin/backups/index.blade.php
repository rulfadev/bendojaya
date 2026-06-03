@extends('layouts.admin')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
        <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Backup Data
                </p>

                <h3 class="mt-2 text-2xl font-black text-stone-950">
                    Export data website ke CSV
                </h3>

                <p class="mt-3 max-w-3xl text-sm leading-7 text-stone-500">
                    Gunakan fitur ini untuk menyimpan salinan data penting website. File CSV bisa dibuka di Excel, Google
                    Sheets, atau diimpor kembali secara manual jika dibutuhkan.
                </p>
            </div>

            <div class="rounded-3xl bg-stone-950 px-6 py-5 text-amber-100">
                <p class="text-xs font-black uppercase tracking-[0.2em] text-amber-300">
                    Saran
                </p>
                <p class="mt-2 text-sm font-semibold leading-6 text-stone-200">
                    Backup minimal seminggu sekali.
                </p>
            </div>
        </div>
    </section>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($exports as $type => $export)
            <article
                class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl hover:shadow-stone-900/5">
                <div class="flex items-start gap-4">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-stone-950 text-amber-200">
                        <i class="{{ $export['icon'] }}"></i>
                    </div>

                    <div>
                        <h3 class="font-black text-stone-950">
                            {{ $export['label'] }}
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-stone-500">
                            {{ $export['description'] }}
                        </p>
                    </div>
                </div>

                <x-admin.link-button :href="route('admin.backups.export', $type)" class="mt-6 w-full">
                    <i class="fa-solid fa-download"></i>
                    Download CSV
                </x-admin.link-button>
            </article>
        @endforeach
    </div>

    <section class="mt-8 rounded-[2rem] border border-amber-200 bg-amber-50 p-6 text-amber-900">
        <div class="flex gap-4">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-amber-200 text-amber-900">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>

            <div>
                <h3 class="font-black">Catatan penting</h3>
                <p class="mt-2 text-sm leading-7">
                    Export CSV hanya membackup data database. File gambar tetap perlu dibackup dari folder
                    <code class="rounded bg-white px-2 py-1">storage/app/public</code>
                    atau melalui File Manager cPanel.
                </p>
            </div>
        </div>
    </section>
@endsection
