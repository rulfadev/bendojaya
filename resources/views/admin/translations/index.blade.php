@extends('layouts.admin')

@section('content')
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($resources as $key => $resource)
            <a href="{{ route('admin.translations.list', $key) }}"
                class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl hover:shadow-stone-900/5">
                <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-950 text-amber-200">
                    <i class="fa-solid fa-language"></i>
                </div>

                <h3 class="text-lg font-black text-stone-950">
                    {{ $resource['label'] }}
                </h3>

                <p class="mt-2 text-sm font-semibold leading-6 text-stone-500">
                    Kelola konten English untuk {{ $resource['label'] }}.
                </p>
            </a>
        @endforeach
    </div>
@endsection
