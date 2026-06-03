<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsappTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WhatsappTemplateController extends Controller
{
    public function index(): View
    {
        $templates = WhatsappTemplate::query()
            ->orderBy('sort_order')
            ->get();

        foreach (WhatsappTemplate::KEYS as $key => $label) {
            if (! $templates->contains('key', $key)) {
                WhatsappTemplate::query()->create([
                    'key' => $key,
                    'label' => $label,
                    'message' => WhatsappTemplate::defaultMessages()[$key],
                    'is_active' => true,
                    'sort_order' => array_search($key, array_keys(WhatsappTemplate::KEYS), true) + 1,
                ]);
            }
        }

        $templates = WhatsappTemplate::query()
            ->orderBy('sort_order')
            ->get();

        return view('admin.whatsapp-templates.index', [
            'title' => 'WhatsApp Templates',
            'subtitle' => 'Kelola template pesan WhatsApp untuk tombol konsultasi.',
            'templates' => $templates,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'templates' => ['required', 'array'],
            'templates.*.message' => ['required', 'string'],
            'templates.*.is_active' => ['nullable', 'boolean'],
        ]);

        foreach ($validated['templates'] as $id => $data) {
            $template = WhatsappTemplate::query()->find($id);

            if (! $template) {
                continue;
            }

            $template->update([
                'message' => $data['message'],
                'is_active' => $request->boolean("templates.{$id}.is_active"),
            ]);
        }

        return back()->with('success', 'Template WhatsApp berhasil diperbarui.');
    }
}
