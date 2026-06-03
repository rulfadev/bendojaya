@extends('layouts.admin')

@section('content')
    <div class="grid gap-8 xl:grid-cols-3">
        <div class="xl:col-span-2">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Pesan
                </p>

                <h3 class="mt-3 text-2xl font-black text-stone-950">
                    {{ $message->subject ?: 'Tanpa subjek' }}
                </h3>

                <div class="mt-6 rounded-3xl bg-white p-6 text-sm leading-7 text-stone-700">
                    {!! nl2br(e($message->message)) !!}
                </div>
            </section>
        </div>

        <div class="space-y-8">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Pengirim
                </p>

                <div class="mt-5 space-y-4 text-sm">
                    <div>
                        <p class="font-black text-stone-950">Nama</p>
                        <p class="mt-1 text-stone-600">{{ $message->name }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Email</p>
                        <p class="mt-1 text-stone-600">{{ $message->email ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Telepon / WhatsApp</p>
                        <p class="mt-1 text-stone-600">{{ $message->phone ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Tanggal</p>
                        <p class="mt-1 text-stone-600">{{ $message->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Source URL</p>
                        <p class="mt-1 break-all text-stone-600">{{ $message->source_url ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Dihubungi</p>
                        <p class="mt-1 text-stone-600">{{ $message->contacted_at?->format('d M Y H:i') ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Selesai</p>
                        <p class="mt-1 text-stone-600">{{ $message->completed_at?->format('d M Y H:i') ?: '-' }}</p>
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Follow Up
                </p>

                <form action="{{ route('admin.contact-messages.status', $message) }}" method="POST" class="mt-5 space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="mb-2 block text-sm font-black text-stone-800">Status</label>
                        <select name="status"
                            class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none">
                            @foreach (\App\Models\ContactMessage::STATUSES as $value => $label)
                                <option value="{{ $value }}" @selected($message->status === $value)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-black text-stone-800">Catatan Follow Up</label>
                        <textarea name="follow_up_note" rows="5"
                            class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none"
                            placeholder="Contoh: Sudah dibalas via WhatsApp, menunggu konfirmasi ukuran.">{{ old('follow_up_note', $message->follow_up_note) }}</textarea>
                    </div>

                    <button class="w-full rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200">
                        Simpan Status
                    </button>
                </form>
            </section>

            <section class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 shadow-sm">
                <a href="{{ route('admin.contact-messages.index') }}"
                    class="inline-flex w-full justify-center rounded-2xl border border-white/10 px-5 py-3 text-sm font-black text-stone-200">
                    Kembali
                </a>

                @if ($message->phone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank"
                        class="mt-3 inline-flex w-full justify-center rounded-2xl bg-amber-300 px-5 py-3 text-sm font-black text-stone-950">
                        Balas via WhatsApp
                    </a>
                @endif

                @if ($message->email)
                    <a href="mailto:{{ $message->email }}"
                        class="mt-3 inline-flex w-full justify-center rounded-2xl bg-white px-5 py-3 text-sm font-black text-stone-950">
                        Balas via Email
                    </a>
                @endif
            </section>
        </div>
    </div>
@endsection
