<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    private function authorizeAdmin(Request $request): void
    {
        abort_unless($request->user()?->role === 'admin', 403, 'Hanya admin yang dapat mengelola user.');
    }

    public function index(Request $request): View
    {
        $this->authorizeAdmin($request);

        $users = User::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');

                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('role'), fn ($query) => $query->where('role', $request->role))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', [
            'title' => 'User Management',
            'subtitle' => 'Kelola akun admin, editor, dan staff.',
            'users' => $users,
        ]);
    }

    public function create(Request $request): View
    {
        $this->authorizeAdmin($request);

        return view('admin.users.create', [
            'title' => 'Tambah User',
            'subtitle' => 'Buat akun baru untuk mengakses panel.',
            'userData' => new User([
                'role' => 'staff',
                'is_active' => true,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:150'],
                'username' => ['required', 'string', 'alpha_dash', 'max:100', 'unique:users,username'],
                'email' => ['required', 'email', 'max:150', 'unique:users,email'],
                'role' => ['required', Rule::in(array_keys(User::ROLES))],
                'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
                'is_active' => ['nullable', 'boolean'],
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'username.required' => 'Username wajib diisi.',
                'username.alpha_dash' => 'Username hanya boleh huruf, angka, strip, dan underscore.',
                'username.unique' => 'Username sudah digunakan.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'role.required' => 'Role wajib dipilih.',
                'password.required' => 'Password wajib diisi.',
                'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            ]
        );

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->boolean('is_active');

        User::query()->create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(Request $request, User $user): View
    {
        $this->authorizeAdmin($request);

        return view('admin.users.edit', [
            'title' => 'Edit User',
            'subtitle' => 'Perbarui akun panel.',
            'userData' => $user,
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:150'],
                'username' => [
                    'required',
                    'string',
                    'alpha_dash',
                    'max:100',
                    Rule::unique('users', 'username')->ignore($user->id),
                ],
                'email' => [
                    'required',
                    'email',
                    'max:150',
                    Rule::unique('users', 'email')->ignore($user->id),
                ],
                'role' => ['required', Rule::in(array_keys(User::ROLES))],
                'password' => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()],
                'is_active' => ['nullable', 'boolean'],
            ]
        );

        if ($request->user()->is($user)) {
            $validated['is_active'] = true;
            $validated['role'] = $user->role;
        } else {
            $validated['is_active'] = $request->boolean('is_active');
        }

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($user->role === 'admin' && $validated['role'] !== 'admin') {
            $this->ensureAnotherActiveAdmin($user);
        }

        if ($user->role === 'admin' && ! $validated['is_active']) {
            $this->ensureAnotherActiveAdmin($user);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $this->authorizeAdmin($request);

        if ($request->user()->is($user)) {
            return back()->with('error', 'Akun sendiri tidak boleh dihapus.');
        }

        if ($user->role === 'admin') {
            $this->ensureAnotherActiveAdmin($user);
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    private function ensureAnotherActiveAdmin(User $user): void
    {
        $hasAnotherAdmin = User::query()
            ->where('role', 'admin')
            ->where('is_active', true)
            ->whereKeyNot($user->id)
            ->exists();

        abort_unless($hasAnotherAdmin, 422, 'Minimal harus ada satu admin aktif.');
    }
}
