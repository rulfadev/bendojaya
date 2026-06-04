<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
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

        return back()->with('success', 'Terima kasih. Penawaran telah disetujui.');
    }

    public function reject(Request $request, string $quotation, string $token): RedirectResponse
    {
        $quotation = $this->findByToken($quotation, $token);

        $quotation->update([
            'status' => 'rejected',
            'rejected_at' => $quotation->rejected_at ?: now(),
            'client_responded_at' => now(),
        ]);

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
