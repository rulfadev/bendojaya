<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'title' => 'Profil Admin',
            'subtitle' => 'Kelola informasi akun dan password panel.',
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:150'],
                'username' => [
                    'required',
                    'string',
                    'max:100',
                    'alpha_dash',
                    Rule::unique('users', 'username')->ignore($user->id),
                ],
                'email' => [
                    'required',
                    'email',
                    'max:150',
                    Rule::unique('users', 'email')->ignore($user->id),
                ],
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'name.max' => 'Nama maksimal 150 karakter.',

                'username.required' => 'Username wajib diisi.',
                'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, strip, dan underscore.',
                'username.unique' => 'Username sudah digunakan.',
                'username.max' => 'Username maksimal 100 karakter.',

                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'email.max' => 'Email maksimal 150 karakter.',
            ]
        );

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            ],
            [
                'current_password.required' => 'Password lama wajib diisi.',
                'current_password.current_password' => 'Password lama tidak sesuai.',

                'password.required' => 'Password baru wajib diisi.',
                'password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
                'password.min' => 'Password baru minimal 8 karakter.',
                'password.letters' => 'Password baru harus mengandung huruf.',
                'password.numbers' => 'Password baru harus mengandung angka.',
            ]
        );

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
