<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollectionInquiry;
use App\Models\PartnershipInquiry;
use App\Models\Quotation;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(): View
    {
        $collectionInquiries = CollectionInquiry::query()
            ->with('collection')
            ->where('status', 'new')
            ->latest()
            ->take(10)
            ->get();

        $partnershipInquiries = PartnershipInquiry::query()
            ->where('status', 'new')
            ->latest()
            ->take(10)
            ->get();

        $approvedQuotations = Quotation::query()
            ->where('status', 'approved')
            ->latest('client_responded_at')
            ->take(10)
            ->get();

        $rejectedQuotations = Quotation::query()
            ->where('status', 'rejected')
            ->latest('client_responded_at')
            ->take(10)
            ->get();

        $viewedQuotations = Quotation::query()
            ->whereNotNull('viewed_at')
            ->whereIn('status', ['draft', 'sent'])
            ->latest('viewed_at')
            ->take(10)
            ->get();

        return view('admin.notifications.index', [
            'title' => 'Notifikasi',
            'subtitle' => 'Ringkasan data yang perlu ditindaklanjuti.',
            'collectionInquiries' => $collectionInquiries,
            'partnershipInquiries' => $partnershipInquiries,
            'approvedQuotations' => $approvedQuotations,
            'rejectedQuotations' => $rejectedQuotations,
            'viewedQuotations' => $viewedQuotations,
        ]);
    }
}
