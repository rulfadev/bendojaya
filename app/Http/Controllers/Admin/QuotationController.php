<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollectionInquiry;
use App\Models\PartnershipInquiry;
use App\Models\Quotation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class QuotationController extends Controller
{
    public function index(Request $request): View
    {
        $quotations = Quotation::query()
            ->withCount('items')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');

                $query->where(function ($query) use ($search) {
                    $query->where('quotation_number', 'like', "%{$search}%")
                        ->orWhere('client_name', 'like', "%{$search}%")
                        ->orWhere('company_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.quotations.index', [
            'title' => 'Quotation',
            'subtitle' => 'Kelola penawaran harga untuk calon client.',
            'quotations' => $quotations,
        ]);
    }

    public function create(Request $request): View
    {
        $quotation = new Quotation([
            'quotation_number' => $this->generateNumber(),
            'quotation_date' => now()->toDateString(),
            'valid_until' => now()->addDays(14)->toDateString(),
            'status' => 'draft',
            'discount_amount' => 0,
            'tax_amount' => 0,
            'terms' => "1. Harga berlaku sesuai tanggal valid penawaran.\n2. Produksi dimulai setelah pembayaran awal disepakati.\n3. Detail bahan, ukuran, dan desain akan dikonfirmasi sebelum produksi.",
        ]);

        if ($request->filled('partnership_inquiry_id')) {
            $inquiry = PartnershipInquiry::query()->find($request->partnership_inquiry_id);

            if ($inquiry) {
                $quotation->partnership_inquiry_id = $inquiry->id;
                $quotation->client_name = $inquiry->pic_name;
                $quotation->company_name = $inquiry->company_name;
                $quotation->email = $inquiry->email;
                $quotation->phone = $inquiry->phone;
                $quotation->title = 'Penawaran Kerja Sama '.($inquiry->company_name ?: $inquiry->pic_name);
            }
        }

        if ($request->filled('collection_inquiry_id')) {
            $inquiry = CollectionInquiry::query()->with('collection')->find($request->collection_inquiry_id);

            if ($inquiry) {
                $quotation->collection_inquiry_id = $inquiry->id;
                $quotation->client_name = $inquiry->name;
                $quotation->email = $inquiry->email;
                $quotation->phone = $inquiry->phone;
                $quotation->title = 'Penawaran Koleksi '.($inquiry->collection?->name ?: 'Bendo Jaya');
            }
        }

        return view('admin.quotations.create', [
            'title' => 'Buat Quotation',
            'subtitle' => 'Buat penawaran harga baru.',
            'quotation' => $quotation,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($request, $validated) {
            $quotation = Quotation::query()->create([
                ...$validated,
                'user_id' => $request->user()?->id,
                'quotation_number' => $validated['quotation_number'] ?: $this->generateNumber(),
            ]);

            $this->syncItems($quotation, $request->input('items', []));
            $this->recalculate($quotation);
        });

        return redirect()
            ->route('admin.quotations.index')
            ->with('success', 'Quotation berhasil dibuat.');
    }

    public function show(Quotation $quotation): View
    {
        $quotation->load('items', 'collectionInquiry.collection', 'partnershipInquiry');

        return view('admin.quotations.show', [
            'title' => 'Detail Quotation',
            'subtitle' => 'Lihat detail penawaran harga.',
            'quotation' => $quotation,
        ]);
    }

    public function edit(Quotation $quotation): View
    {
        $quotation->load('items');

        return view('admin.quotations.edit', [
            'title' => 'Edit Quotation',
            'subtitle' => 'Perbarui penawaran harga.',
            'quotation' => $quotation,
        ]);
    }

    public function update(Request $request, Quotation $quotation): RedirectResponse
    {
        $validated = $this->validated($request, $quotation);

        DB::transaction(function () use ($request, $quotation, $validated) {
            $quotation->update($validated);

            $quotation->items()->delete();

            $this->syncItems($quotation, $request->input('items', []));
            $this->recalculate($quotation);
        });

        return redirect()
            ->route('admin.quotations.show', $quotation)
            ->with('success', 'Quotation berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Quotation $quotation): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:draft,sent,approved,rejected,expired'],
        ]);

        $payload = [
            'status' => $validated['status'],
        ];

        if ($validated['status'] === 'sent' && ! $quotation->sent_at) {
            $payload['sent_at'] = now();
        }

        if ($validated['status'] === 'approved' && ! $quotation->approved_at) {
            $payload['approved_at'] = now();
        }

        if ($validated['status'] === 'rejected' && ! $quotation->rejected_at) {
            $payload['rejected_at'] = now();
        }

        $quotation->update($payload);

        return back()->with('success', 'Status quotation berhasil diperbarui.');
    }

    public function destroy(Quotation $quotation): RedirectResponse
    {
        $quotation->delete();

        return redirect()
            ->route('admin.quotations.index')
            ->with('success', 'Quotation berhasil dihapus.');
    }

    private function validated(Request $request, ?Quotation $quotation = null): array
    {
        return $request->validate([
            'collection_inquiry_id' => ['nullable', 'exists:collection_inquiries,id'],
            'partnership_inquiry_id' => ['nullable', 'exists:partnership_inquiries,id'],
            'quotation_number' => ['nullable', 'string', 'max:80'],
            'title' => ['nullable', 'string', 'max:180'],
            'client_name' => ['required', 'string', 'max:150'],
            'company_name' => ['nullable', 'string', 'max:150'],
            'email' => ['nullable', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'quotation_date' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,sent,approved,rejected,expired'],
            'discount_amount' => ['nullable', 'numeric', 'min:0'],
            'tax_amount' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'terms' => ['nullable', 'string'],
            'items' => ['nullable', 'array'],
            'items.*.item_name' => ['nullable', 'string', 'max:180'],
            'items.*.description' => ['nullable', 'string'],
            'items.*.quantity' => ['nullable', 'numeric', 'min:0'],
            'items.*.unit' => ['nullable', 'string', 'max:50'],
            'items.*.unit_price' => ['nullable', 'numeric', 'min:0'],
        ]);
    }

    private function syncItems(Quotation $quotation, array $items): void
    {
        foreach ($items as $index => $item) {
            if (blank($item['item_name'] ?? null)) {
                continue;
            }

            $quantity = (float) ($item['quantity'] ?? 1);
            $unitPrice = (float) ($item['unit_price'] ?? 0);

            $quotation->items()->create([
                'item_name' => $item['item_name'],
                'description' => $item['description'] ?? null,
                'quantity' => $quantity,
                'unit' => $item['unit'] ?? 'pcs',
                'unit_price' => $unitPrice,
                'subtotal' => $quantity * $unitPrice,
                'sort_order' => $index + 1,
            ]);
        }
    }

    private function recalculate(Quotation $quotation): void
    {
        $subtotal = (float) $quotation->items()->sum('subtotal');
        $discount = (float) $quotation->discount_amount;
        $tax = (float) $quotation->tax_amount;
        $total = max(0, $subtotal - $discount + $tax);

        $quotation->update([
            'subtotal' => $subtotal,
            'total_amount' => $total,
        ]);
    }

    private function generateNumber(): string
    {
        $prefix = 'QTN-'.now()->format('Ym').'-';

        $last = Quotation::query()
            ->where('quotation_number', 'like', $prefix.'%')
            ->latest('id')
            ->first();

        $next = $last
            ? ((int) str_replace($prefix, '', $last->quotation_number)) + 1
            : 1;

        return $prefix.str_pad((string) $next, 4, '0', STR_PAD_LEFT);
    }
}
