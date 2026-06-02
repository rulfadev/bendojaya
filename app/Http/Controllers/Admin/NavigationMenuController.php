<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\NavigationMenu;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class NavigationMenuController extends Controller
{
    public function index(): View
    {
        $menus = NavigationMenu::query()
            ->with(['page', 'article'])
            ->orderBy('sort_order')
            ->latest()
            ->paginate(15);

        return view('admin.navigation-menus.index', [
            'title' => 'Menu Navigasi',
            'subtitle' => 'Kelola menu header dan footer website.',
            'menus' => $menus,
        ]);
    }

    public function create(): View
    {
        return view('admin.navigation-menus.create', [
            'title' => 'Tambah Menu',
            'subtitle' => 'Tambahkan menu navigasi baru.',
            'menu' => new NavigationMenu([
                'type' => 'custom',
                'position' => 'header',
                'target' => '_self',
                'is_active' => true,
                'sort_order' => 0,
            ]),
            'pages' => Page::query()->active()->orderBy('title')->get(),
            'articles' => Article::query()->active()->orderBy('title')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        NavigationMenu::query()->create($this->validated($request));

        return redirect()
            ->route('admin.navigation-menus.index')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(NavigationMenu $navigationMenu): View
    {
        return view('admin.navigation-menus.edit', [
            'title' => 'Edit Menu',
            'subtitle' => 'Perbarui menu navigasi.',
            'menu' => $navigationMenu,
            'pages' => Page::query()->active()->orderBy('title')->get(),
            'articles' => Article::query()->active()->orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, NavigationMenu $navigationMenu): RedirectResponse
    {
        $navigationMenu->update($this->validated($request));

        return redirect()
            ->route('admin.navigation-menus.index')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(NavigationMenu $navigationMenu): RedirectResponse
    {
        $navigationMenu->delete();

        return redirect()
            ->route('admin.navigation-menus.index')
            ->with('success', 'Menu berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate(
            [
                'label' => ['required', 'string', 'max:100'],
                'type' => ['required', Rule::in(array_keys(NavigationMenu::TYPES))],
                'url' => ['nullable', 'string', 'max:255'],
                'page_id' => ['nullable', 'exists:pages,id'],
                'article_id' => ['nullable', 'exists:articles,id'],
                'anchor' => ['nullable', 'string', 'max:120'],
                'position' => ['required', Rule::in(array_keys(NavigationMenu::POSITIONS))],
                'target' => ['required', Rule::in(array_keys(NavigationMenu::TARGETS))],
                'sort_order' => ['nullable', 'integer', 'min:0'],
                'is_active' => ['nullable', 'boolean'],
            ],
            [
                'label.required' => 'Label menu wajib diisi.',
                'type.required' => 'Tipe link wajib dipilih.',
                'position.required' => 'Posisi menu wajib dipilih.',
                'target.required' => 'Target link wajib dipilih.',
            ]
        );

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($validated['type'] !== 'page') {
            $validated['page_id'] = null;
        }

        if ($validated['type'] !== 'article') {
            $validated['article_id'] = null;
        }

        return $validated;
    }
}
