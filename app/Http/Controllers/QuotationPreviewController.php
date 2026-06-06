<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\SiteSetting;
use App\Support\AdminNotifier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuotationPreviewController extends Controller
{
    public function show(string $quotation, string $token): View
    {
        $quotation = Quotation::query()
            ->with('items')
            ->where('quotation_number', $quotation)
            ->firstOrFail();

        abort_unless(hash_equals((string) $quotation->public_token, $token), 403);

        if (! $quotation->viewed_at) {
            $quotation->update([
                'viewed_at' => now(),
            ]);
        }

        if (! $quotation->viewed_at) {
            $quotation->update([
                'viewed_at' => now(),
            ]);

            AdminNotifier::send(
                'quotation_viewed',
                'Quotation dilihat client',
                "{$quotation->quotation_number} dilihat oleh {$quotation->client_name}.",
                route('admin.quotations.show', $quotation),
                [
                    'id' => $quotation->id,
                    'quotation_number' => $quotation->quotation_number,
                ]
            );
        }

        return view('quotations.preview', [
            'quotation' => $quotation,
            'title' => $quotation->quotation_number.' - Penawaran Bendo Jaya',
            'metaDescription' => 'Detail penawaran Bendo Jaya untuk '.$quotation->client_name,
            'robots' => 'noindex, nofollow',
        ]);
    }

    public function approve(Request $request, string $quotation, string $token): RedirectResponse
    {
        $quotation = $this->findByToken($quotation, $token);

        $quotation->update([
            'status' => 'approved',
            'approved_at' => $quotation->approved_at ?: now(),
            'client_responded_at' => now(),
        ]);

        AdminNotifier::send(
            'quotation_approved',
            'Quotation disetujui client',
            "{$quotation->quotation_number} disetujui oleh {$quotation->client_name}.",
            route('admin.quotations.show', $quotation),
            [
                'id' => $quotation->id,
                'quotation_number' => $quotation->quotation_number,
            ]
        );

        $setting = SiteSetting::query()->first();

        $adminWhatsapp = preg_replace('/[^0-9]/', '', $setting?->whatsapp_number ?? '6280000000000');

        if (str_starts_with($adminWhatsapp, '0')) {
            $adminWhatsapp = '62'.substr($adminWhatsapp, 1);
        }

        $message = "Halo admin Bendo Jaya, saya sudah menyetujui penawaran/quotation.\n\n";
        $message .= "Nomor Penawaran: {$quotation->quotation_number}\n";
        $message .= "Nama Client: {$quotation->client_name}\n";
        $message .= 'Perusahaan/Brand: '.($quotation->company_name ?: '-')."\n";
        $message .= "Total Penawaran: {$quotation->formatted_total}\n\n";
        $message .= 'Mohon dikonfirmasi untuk proses kerja sama / produksi selanjutnya.';

        $whatsappUrl = 'https://wa.me/'.$adminWhatsapp.'?text='.rawurlencode($message);

        return redirect()->away($whatsappUrl);
    }

    public function reject(Request $request, string $quotation, string $token): RedirectResponse
    {
        $quotation = $this->findByToken($quotation, $token);

        $quotation->update([
            'status' => 'rejected',
            'rejected_at' => $quotation->rejected_at ?: now(),
            'client_responded_at' => now(),
        ]);

        AdminNotifier::send(
            'quotation_rejected',
            'Quotation ditolak client',
            "{$quotation->quotation_number} ditolak oleh {$quotation->client_name}.",
            route('admin.quotations.show', $quotation),
            [
                'id' => $quotation->id,
                'quotation_number' => $quotation->quotation_number,
            ]
        );

        return back()->with('success', 'Terima kasih. Penawaran telah ditandai tidak disetujui.');
    }

    private function findByToken(string $quotationNumber, string $token): Quotation
    {
        $quotation = Quotation::query()
            ->where('quotation_number', $quotationNumber)
            ->firstOrFail();

        abort_unless(hash_equals((string) $quotation->public_token, $token), 403);

        return $quotation;
    }
}
