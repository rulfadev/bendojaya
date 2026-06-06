@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <form method="GET" class="grid gap-3 lg:grid-cols-[180px_220px_auto]">
            <x-admin.form.select name="status">
                <option value="">Semua Status</option>
                <option value="unread" @selected(request('status') === 'unread')>Belum Dibaca</option>
                <option value="read" @selected(request('status') === 'read')>Sudah Dibaca</option>
            </x-admin.form.select>

            <x-admin.form.select name="type">
                <option value="">Semua Tipe</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}" @selected(request('type') === $type)>
                        {{ str($type)->replace('_', ' ')->title() }}
                    </option>
                @endforeach
            </x-admin.form.select>

            <x-admin.button>
                <i class="fa-solid fa-filter"></i>
                Filter
            </x-admin.button>
        </form>

        <form action="{{ route('admin.notifications.mark-all-as-read') }}" method="POST">
            @csrf

            <x-admin.button variant="light">
                <i class="fa-solid fa-check-double"></i>
                Tandai Semua Dibaca
            </x-admin.button>
        </form>
    </div>

    <div class="space-y-4">
        @forelse ($notifications as $notification)
            <article
                class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-stone-900/5">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <a href="{{ route('admin.notifications.read', $notification) }}" class="flex flex-1 gap-4">
                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl {{ $notification->color_class }}">
                            <i class="{{ $notification->icon }}"></i>
                        </div>

                        <div>
                            <div class="flex flex-wrap items-center gap-2">
                                <h3 class="font-black text-stone-950">
                                    {{ $notification->title }}
                                </h3>

                                @if (!$notification->is_read)
                                    <span class="rounded-full bg-red-100 px-2 py-0.5 text-[10px] font-black text-red-700">
                                        Baru
                                    </span>
                                @endif
                            </div>

                            @if ($notification->message)
                                <p class="mt-2 text-sm font-semibold leading-7 text-stone-500">
                                    {{ $notification->message }}
                                </p>
                            @endif

                            <p class="mt-3 text-xs font-semibold text-stone-400">
                                {{ $notification->created_at?->diffForHumans() }}
                            </p>
                        </div>
                    </a>

                    <div class="flex gap-2 md:justify-end">
                        @if (!$notification->is_read)
                            <form action="{{ route('admin.notifications.mark-as-read', $notification) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <x-admin.button variant="light" class="px-4 py-2 text-xs">
                                    Dibaca
                                </x-admin.button>
                            </form>
                        @endif

                        <form action="{{ route('admin.notifications.destroy', $notification) }}" method="POST"
                            data-confirm-delete data-confirm-message="Notifikasi ini akan dihapus.">
                            @csrf
                            @method('DELETE')

                            <x-admin.button variant="danger" class="px-4 py-2 text-xs">
                                Hapus
                            </x-admin.button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div
                class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-10 text-center text-sm font-semibold text-stone-500">
                Belum ada notifikasi.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
@endsection
