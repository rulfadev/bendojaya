<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Bendo Jaya</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f8f2e8] text-stone-900 antialiased">
    <div class="pointer-events-none fixed inset-0 opacity-[0.07]"
        style="background-image: radial-gradient(circle at 1px 1px, #3b2415 1px, transparent 0); background-size: 24px 24px;">
    </div>

    <main class="relative flex min-h-screen items-center justify-center px-5 py-10">
        <div
            class="grid w-full max-w-6xl overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-2xl shadow-stone-900/10 lg:grid-cols-2">
            <section class="relative hidden overflow-hidden bg-stone-950 p-10 text-white lg:block">
                <div class="absolute inset-0 opacity-20"
                    style="background-image: radial-gradient(circle at 2px 2px, #fbbf24 1px, transparent 0); background-size: 28px 28px;">
                </div>

                <div class="relative flex h-full flex-col justify-between">
                    <div>
                        <div
                            class="mb-8 flex h-16 w-16 items-center justify-center rounded-3xl bg-amber-300 text-2xl font-black text-stone-950">
                            BJ
                        </div>

                        <p class="text-sm font-black uppercase tracking-[0.3em] text-amber-300">Bendo Jaya CMS</p>
                        <h1 class="mt-5 max-w-md text-5xl font-black leading-tight tracking-tight">
                            Batik tradisional dengan tata kelola digital modern.
                        </h1>
                        <p class="mt-6 max-w-md text-base leading-8 text-stone-300">
                            Kelola gallery, artikel, koleksi, halaman custom, dan kerja sama brand dalam satu admin
                            panel yang bersih.
                        </p>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                            <p class="text-2xl font-black text-amber-300">01</p>
                            <p class="mt-1 text-xs font-semibold text-stone-300">Konten</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                            <p class="text-2xl font-black text-amber-300">02</p>
                            <p class="mt-1 text-xs font-semibold text-stone-300">Gallery</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                            <p class="text-2xl font-black text-amber-300">03</p>
                            <p class="mt-1 text-xs font-semibold text-stone-300">Koleksi</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="p-6 sm:p-10">
                <div class="mx-auto flex min-h-[620px] max-w-md flex-col justify-center">
                    <div class="mb-8">
                        <div
                            class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-stone-950 text-lg font-black text-amber-300 lg:hidden">
                            BJ
                        </div>

                        <p class="text-sm font-black uppercase tracking-[0.25em] text-amber-700">Admin Login</p>
                        <h2 class="mt-3 text-3xl font-black tracking-tight text-stone-950">Masuk ke CMS</h2>
                        <p class="mt-3 text-sm leading-6 text-stone-500">
                            Gunakan akun admin untuk mengelola website Bendo Jaya.
                        </p>
                    </div>

                    @if (session('success'))
                        <div
                            class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @error('login')
                        <div
                            class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-bold text-red-700">
                            {{ $message }}
                        </div>
                    @enderror

                    <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label for="login" class="mb-2 block text-sm font-black text-stone-800">
                                Username / Email
                            </label>
                            <input type="text" id="login" name="login" value="{{ old('login') }}"
                                autocomplete="username" autofocus
                                class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm font-semibold text-stone-800 outline-none transition placeholder:text-stone-400 focus:border-stone-950 focus:ring-4 focus:ring-amber-200"
                                placeholder="admin atau admin@bendojaya.id">
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-black text-stone-800">
                                Password
                            </label>
                            <input type="password" id="password" name="password" autocomplete="current-password"
                                class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm font-semibold text-stone-800 outline-none transition placeholder:text-stone-400 focus:border-stone-950 focus:ring-4 focus:ring-amber-200"
                                placeholder="Masukkan password">
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-2 text-sm font-semibold text-stone-600">
                                <input type="checkbox" name="remember" value="1"
                                    class="rounded border-stone-300 text-stone-950 focus:ring-amber-300">
                                Ingat saya
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full rounded-2xl bg-stone-950 px-5 py-3.5 text-sm font-black text-amber-200 shadow-xl shadow-stone-900/10 transition hover:-translate-y-0.5 hover:bg-stone-800">
                            Masuk Admin Panel
                        </button>
                    </form>

                    <div class="mt-8 rounded-3xl border border-amber-200 bg-amber-50/70 p-5">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-amber-800">Akun Awal</p>
                        <p class="mt-2 text-sm leading-6 text-stone-600">
                            Username: <strong>admin</strong><br>
                            Password: <strong>password</strong>
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>

</html>
