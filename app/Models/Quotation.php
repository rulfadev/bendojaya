<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable(['user_id', 'collection_inquiry_id', 'partnership_inquiry_id', 'quotation_number', 'title', 'client_name', 'company_name', 'email', 'phone', 'quotation_date', 'valid_until', 'status', 'subtotal', 'discount_amount', 'tax_amount', 'total_amount', 'notes', 'terms', 'sent_at', 'approved_at', 'rejected_at', 'public_token', 'viewed_at', 'client_responded_at'])]
class Quotation extends Model
{
    protected function casts(): array
    {
        return [
            'quotation_date' => 'date',
            'valid_until' => 'date',
            'subtotal' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'sent_at' => 'datetime',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
            'viewed_at' => 'datetime',
            'client_responded_at' => 'datetime',
        ];
    }

    public const STATUSES = [
        'draft' => 'Draft',
        'sent' => 'Terkirim',
        'approved' => 'Disetujui',
        'rejected' => 'Ditolak',
        'expired' => 'Expired',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class)->orderBy('sort_order');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function collectionInquiry(): BelongsTo
    {
        return $this->belongsTo(CollectionInquiry::class);
    }

    public function partnershipInquiry(): BelongsTo
    {
        return $this->belongsTo(PartnershipInquiry::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? 'Draft';
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp '.number_format((float) $this->total_amount, 0, ',', '.');
    }

    public function getWhatsappUrlAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', (string) $this->phone);

        if (str_starts_with($phone, '0')) {
            $phone = '62'.substr($phone, 1);
        }

        $message = "Halo {$this->client_name}, berikut penawaran dari Bendo Jaya.\n\n";
        $message .= "No: {$this->quotation_number}\n";
        $message .= 'Judul: '.($this->title ?: 'Penawaran Bendo Jaya')."\n";
        $message .= "Total: {$this->formatted_total}\n";

        if ($this->valid_until) {
            $message .= "Berlaku sampai: {$this->valid_until->format('d M Y')}\n";
        }

        $message .= "\nLink penawaran:\n{$this->public_url}\n\n";
        $message .= 'Silakan cek dan konfirmasi jika penawaran sudah sesuai.';

        return 'https://wa.me/'.$phone.'?text='.rawurlencode($message);
    }

    protected static function booted(): void
    {
        static::creating(function (Quotation $quotation) {
            if (! $quotation->public_token) {
                $quotation->public_token = Str::random(48);
            }
        });
    }

    public function ensurePublicToken(): string
    {
        if (! $this->public_token) {
            $this->forceFill([
                'public_token' => Str::random(48),
            ])->save();
        }

        return $this->public_token;
    }

    public function getPublicUrlAttribute(): string
    {
        return route('quotations.preview', [
            'quotation' => $this->quotation_number,
            'token' => $this->ensurePublicToken(),
        ]);
    }
}
