@extends('layouts.admin')

@section('content')
    @php
        $inputClass =
            'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition placeholder:text-stone-400 focus:border-stone-950 focus:ring-4 focus:ring-amber-200';
        $labelClass = 'mb-2 block text-sm font-black text-stone-800';
        $cardClass = 'rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm';
    @endphp

    <div class="grid gap-8 xl:grid-cols-3">
        <div class="xl:col-span-2 space-y-8">
            <section class="{{ $cardClass }}">
                <div class="mb-6">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                        Informasi Akun
                    </p>
                    <h3 class="mt-2 text-xl font-black text-stone-950">
                        Profil Pengelola
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-stone-500">
                        Perbarui nama, username, dan email akun panel.
                    </p>
                </div>

                <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-5 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label for="name" class="{{ $labelClass }}">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                class="{{ $inputClass }}" placeholder="Nama pengelola">
                        </div>

                        <div>
                            <label for="username" class="{{ $labelClass }}">Username</label>
                            <input type="text" id="username" name="username"
                                value="{{ old('username', $user->username) }}" class="{{ $inputClass }}"
                                placeholder="admin">
                            <p class="mt-2 text-xs font-semibold text-stone-500">
                                Digunakan untuk login selain email.
                            </p>
                        </div>

                        <div>
                            <label for="email" class="{{ $labelClass }}">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                class="{{ $inputClass }}" placeholder="admin@bendojaya.id">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="rounded-2xl bg-stone-950 px-6 py-3 text-sm font-black text-amber-200 transition hover:bg-stone-800">
                            Simpan Profil
                        </button>
                    </div>
                </form>
            </section>

            <section class="{{ $cardClass }}">
                <div class="mb-6">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                        Keamanan
                    </p>
                    <h3 class="mt-2 text-xl font-black text-stone-950">
                        Ubah Password
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-stone-500">
                        Gunakan password yang kuat, minimal 8 karakter, mengandung huruf dan angka.
                    </p>
                </div>

                <form action="{{ route('admin.profile.password.update') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="{{ $labelClass }}">Password Lama</label>
                        <input type="password" id="current_password" name="current_password" class="{{ $inputClass }}"
                            autocomplete="current-password" placeholder="Masukkan password lama">
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="password" class="{{ $labelClass }}">Password Baru</label>
                            <input type="password" id="password" name="password" class="{{ $inputClass }}"
                                autocomplete="new-password" placeholder="Minimal 8 karakter">
                        </div>

                        <div>
                            <label for="password_confirmation" class="{{ $labelClass }}">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="{{ $inputClass }}" autocomplete="new-password" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="rounded-2xl bg-amber-300 px-6 py-3 text-sm font-black text-stone-950 transition hover:bg-amber-200">
                            Ubah Password
                        </button>
                    </div>
                </form>
            </section>
        </div>

        <div class="space-y-8">
            <section
                class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 text-amber-100 shadow-xl shadow-stone-900/10">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-300">
                    Account
                </p>

                <div class="mt-6 flex items-center gap-4">
                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-3xl bg-amber-300 text-xl font-black text-stone-950">
                        {{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}
                    </div>

                    <div>
                        <h3 class="text-lg font-black text-white">{{ $user->name }}</h3>
                        <p class="text-sm font-semibold text-stone-300">{{ '@' . $user->username }}</p>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-amber-300">
                            Email
                        </p>
                        <p class="mt-2 text-sm font-semibold text-stone-200">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-amber-300">
                            Role
                        </p>
                        <p class="mt-2 text-sm font-semibold text-stone-200">
                            {{ ucfirst($user->role) }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-amber-300">
                            Status
                        </p>
                        <p class="mt-2 text-sm font-semibold {{ $user->is_active ? 'text-emerald-300' : 'text-red-300' }}">
                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                        </p>
                    </div>
                </div>
            </section>

            <section class="{{ $cardClass }}">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Catatan Keamanan
                </p>

                <div class="mt-5 space-y-4 text-sm leading-7 text-stone-600">
                    <p>
                        Setelah website masuk hosting, segera ganti password default akun admin.
                    </p>
                    <p>
                        Jangan gunakan password seperti <strong>password</strong>, <strong>admin123</strong>, atau tanggal
                        lahir.
                    </p>
                    <p>
                        Gunakan kombinasi huruf dan angka agar akun panel lebih aman.
                    </p>
                </div>
            </section>
        </div>
    </div>
@endsection
