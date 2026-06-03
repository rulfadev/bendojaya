@php
    $isSelf = $userData->exists && auth()->id() === $userData->id;
@endphp

<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <div class="md:col-span-2">
                    <x-admin.form.input name="name" label="Nama" :value="$userData->name" />
                </div>

                <x-admin.form.input name="username" label="Username" :value="$userData->username" />

                <x-admin.form.input name="email" label="Email" type="email" :value="$userData->email" />

                <div>
                    <x-admin.form.input name="password" label="{{ $userData->exists ? 'Password Baru' : 'Password' }}"
                        type="password" autocomplete="new-password" />

                    @if ($userData->exists)
                        <p class="mt-2 text-xs font-semibold text-stone-500">
                            Kosongkan jika tidak ingin mengganti password.
                        </p>
                    @endif
                </div>

                <x-admin.form.input name="password_confirmation" label="Konfirmasi Password" type="password"
                    autocomplete="new-password" />
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.select name="role" label="Role" @disabled($isSelf)>
                @foreach (\App\Models\User::ROLES as $value => $label)
                    <option value="{{ $value }}" @selected(old('role', $userData->role) === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </x-admin.form.select>

            @if ($isSelf)
                <input type="hidden" name="role" value="{{ $userData->role }}">

                <p class="mt-2 text-xs font-semibold text-stone-500">
                    Role akun sendiri tidak bisa diubah.
                </p>
            @endif

            <div class="mt-5">
                <x-admin.form.toggle name="is_active" label="Aktif" :checked="$userData->is_active ?? true" @disabled($isSelf) />
            </div>

            @if ($isSelf)
                <input type="hidden" name="is_active" value="1">

                <p class="mt-2 text-xs font-semibold text-stone-500">
                    Akun sendiri tidak bisa dinonaktifkan.
                </p>
            @endif
        </section>

        <x-admin.button class="w-full">
            <i class="fa-solid fa-save"></i>
            Simpan User
        </x-admin.button>
    </div>
</div>
