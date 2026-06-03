@extends('layouts.admin')

@section('content')
    <div class="grid gap-8 xl:grid-cols-3">
        <div class="space-y-8 xl:col-span-2">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
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
                            <x-admin.form.input name="name" label="Nama Lengkap" :value="$user->name" />
                        </div>

                        <x-admin.form.input name="username" label="Username" :value="$user->username" />

                        <x-admin.form.input name="email" label="Email" type="email" :value="$user->email" />
                    </div>

                    <div class="flex justify-end">
                        <x-admin.button>
                            <i class="fa-solid fa-save"></i>
                            Simpan Profil
                        </x-admin.button>
                    </div>
                </form>
            </section>

            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <div class="mb-6">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                        Keamanan
                    </p>
                    <h3 class="mt-2 text-xl font-black text-stone-950">
                        Ubah Password
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-stone-500">
                        Gunakan password minimal 8 karakter, mengandung huruf dan angka.
                    </p>
                </div>

                <form action="{{ route('admin.profile.password.update') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <x-admin.form.input name="current_password" label="Password Lama" type="password"
                        autocomplete="current-password" />

                    <div class="grid gap-5 md:grid-cols-2">
                        <x-admin.form.input name="password" label="Password Baru" type="password"
                            autocomplete="new-password" />

                        <x-admin.form.input name="password_confirmation" label="Konfirmasi Password Baru" type="password"
                            autocomplete="new-password" />
                    </div>

                    <div class="flex justify-end">
                        <x-admin.button variant="gold">
                            <i class="fa-solid fa-key"></i>
                            Ubah Password
                        </x-admin.button>
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
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-amber-300">Email</p>
                        <p class="mt-2 text-sm font-semibold text-stone-200">{{ $user->email }}</p>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-amber-300">Role</p>
                        <p class="mt-2 text-sm font-semibold text-stone-200">
                            {{ \App\Models\User::ROLES[$user->role] ?? ucfirst($user->role) }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-amber-300">Status</p>
                        <p class="mt-2 text-sm font-semibold {{ $user->is_active ? 'text-emerald-300' : 'text-red-300' }}">
                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                        </p>
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Catatan Keamanan
                </p>

                <div class="mt-5 space-y-4 text-sm leading-7 text-stone-600">
                    <p>Segera ganti password default setelah website masuk hosting.</p>
                    <p>Jangan gunakan password sederhana seperti <strong>password</strong> atau <strong>admin123</strong>.
                    </p>
                    <p>Gunakan kombinasi huruf dan angka agar akun lebih aman.</p>
                </div>
            </section>
        </div>
    </div>
@endsection
