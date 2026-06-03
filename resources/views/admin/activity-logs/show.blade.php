@extends('layouts.admin')

@section('content')
    @php
        $oldValues = $log->old_values ?? [];
        $newValues = $log->new_values ?? [];
        $fields = collect(array_keys($oldValues))->merge(array_keys($newValues))->unique()->values();
    @endphp

    <div class="grid gap-8 xl:grid-cols-3">
        <div class="space-y-8 xl:col-span-2">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Detail Perubahan
                </p>

                <h3 class="mt-3 text-2xl font-black text-stone-950">
                    {{ $log->description ?: $log->action_label }}
                </h3>

                @if ($fields->isNotEmpty())
                    <div class="mt-6 overflow-hidden rounded-[1.5rem] border border-stone-200 bg-white">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[800px] text-left text-sm">
                                <thead class="bg-stone-50 text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                                    <tr>
                                        <th class="px-5 py-4">Field</th>
                                        <th class="px-5 py-4">Sebelum</th>
                                        <th class="px-5 py-4">Sesudah</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-stone-100">
                                    @foreach ($fields as $field)
                                        <tr class="align-top">
                                            <td class="px-5 py-4 font-black text-stone-800">
                                                {{ $field }}
                                            </td>

                                            <td class="px-5 py-4 text-stone-600">
                                                <pre class="whitespace-pre-wrap break-words font-sans text-sm">{{ data_get($oldValues, $field, '-') }}</pre>
                                            </td>

                                            <td class="px-5 py-4 text-stone-600">
                                                <pre class="whitespace-pre-wrap break-words font-sans text-sm">{{ data_get($newValues, $field, '-') }}</pre>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="mt-6 rounded-[1.5rem] border border-stone-200 bg-white p-6 text-stone-500">
                        Tidak ada detail perubahan.
                    </div>
                @endif
            </section>
        </div>

        <div class="space-y-8">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Informasi Log
                </p>

                <div class="mt-5 space-y-4 text-sm">
                    <div>
                        <p class="font-black text-stone-950">Aksi</p>
                        <p class="mt-1 text-stone-600">{{ $log->action_label }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">User</p>
                        <p class="mt-1 text-stone-600">{{ $log->user?->name ?: 'System' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Modul</p>
                        <p class="mt-1 text-stone-600">{{ $log->subject_name }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">IP Address</p>
                        <p class="mt-1 text-stone-600">{{ $log->ip_address ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Method</p>
                        <p class="mt-1 text-stone-600">{{ $log->method ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">URL</p>
                        <p class="mt-1 break-all text-stone-600">{{ $log->url ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Waktu</p>
                        <p class="mt-1 text-stone-600">{{ $log->created_at?->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 shadow-sm">
                <x-admin.link-button :href="route('admin.activity-logs.index')" variant="light" class="w-full">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </x-admin.link-button>
            </section>
        </div>
    </div>
@endsection
