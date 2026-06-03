@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.whatsapp-templates.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid gap-8 xl:grid-cols-[1fr_340px]">
            <div class="space-y-6">
                @foreach ($templates as $template)
                    <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                        <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                            <div>
                                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                                    {{ $template->key }}
                                </p>

                                <h3 class="mt-2 text-xl font-black text-stone-950">
                                    {{ $template->label }}
                                </h3>
                            </div>

                            <x-admin.form.toggle name="templates[{{ $template->id }}][is_active]" label="Aktif"
                                :checked="$template->is_active" />
                        </div>

                        <x-admin.form.textarea name="templates[{{ $template->id }}][message]" label="Template Pesan"
                            :value="$template->message" rows="7" />
                    </section>
                @endforeach
            </div>

            <div class="space-y-6">
                <section
                    class="sticky top-28 rounded-[2rem] border border-stone-200 bg-stone-950 p-6 text-amber-100 shadow-xl shadow-stone-900/10">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-300">
                        Placeholder
                    </p>

                    <div class="mt-5 space-y-3 text-sm font-semibold text-stone-200">
                        <p><code class="rounded bg-white/10 px-2 py-1">{site_name}</code></p>
                        <p><code class="rounded bg-white/10 px-2 py-1">{page_title}</code></p>
                        <p><code class="rounded bg-white/10 px-2 py-1">{service_title}</code></p>
                        <p><code class="rounded bg-white/10 px-2 py-1">{collection_name}</code></p>
                        <p><code class="rounded bg-white/10 px-2 py-1">{collection_category}</code></p>
                        <p><code class="rounded bg-white/10 px-2 py-1">{current_url}</code></p>
                    </div>

                    <p class="mt-6 text-sm leading-7 text-stone-300">
                        Placeholder akan otomatis diganti sesuai halaman yang membuka WhatsApp.
                    </p>

                    <x-admin.button variant="gold" class="mt-6 w-full">
                        <i class="fa-solid fa-save"></i>
                        Simpan Template
                    </x-admin.button>
                </section>
            </div>
        </div>
    </form>
@endsection
