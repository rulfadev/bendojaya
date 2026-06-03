@php
    $inputClass =
        'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-200';
    $labelClass = 'mb-2 block text-sm font-black text-stone-800';
    $cardClass = 'rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm';

    $isSelf = $userData->exists && auth()->id() === $userData->id;
@endphp

<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="{{ $cardClass }}">
            <div class="grid gap-5 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $userData->name) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Username</label>
                    <input type="text" name="username" value="{{ old('username', $userData->username) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Email</label>
                    <input type="email" name="email" value="{{ old('email', $userData->email) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Password {{ $userData->exists ? 'Baru' : '' }}</label>
                    <input type="password" name="password" class="{{ $inputClass }}" autocomplete="new-password">
                    @if ($userData->exists)
                        <p class="mt-2 text-xs font-semibold text-stone-500">Kosongkan jika tidak ingin mengganti
                            password.</p>
                    @endif
                </div>

                <div>
                    <label class="{{ $labelClass }}">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="{{ $inputClass }}"
                        autocomplete="new-password">
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <label class="{{ $labelClass }}">Role</label>
            <select name="role" class="{{ $inputClass }}" @disabled($isSelf)>
                @foreach (\App\Models\User::ROLES as $value => $label)
                    <option value="{{ $value }}" @selected(old('role', $userData->role) === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            @if ($isSelf)
                <input type="hidden" name="role" value="{{ $userData->role }}">
                <p class="mt-2 text-xs font-semibold text-stone-500">Role akun sendiri tidak bisa diubah.</p>
            @endif

            <label
                class="mt-5 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Aktif</span>
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $userData->is_active ?? true))
                    @disabled($isSelf)>
            </label>

            @if ($isSelf)
                <input type="hidden" name="is_active" value="1">
                <p class="mt-2 text-xs font-semibold text-stone-500">Akun sendiri tidak bisa dinonaktifkan.</p>
            @endif
        </section>

        <button type="submit" class="w-full rounded-2xl bg-stone-950 px-5 py-3.5 text-sm font-black text-amber-200">
            Simpan User
        </button>
    </div>
</div>
