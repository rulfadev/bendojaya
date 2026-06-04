<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['collection_id', 'name', 'email', 'phone', 'size', 'quantity', 'need_type', 'message', 'status', 'follow_up_note', 'contacted_at', 'completed_at', 'source_url', 'ip_address', 'user_agent'])]

class CollectionInquiry extends Model
{
    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'contacted_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public const STATUSES = [
        'new' => 'Baru',
        'contacted' => 'Dihubungi',
        'completed' => 'Selesai',
        'archived' => 'Diarsipkan',
    ];

    public const NEED_TYPES = [
        'personal' => 'Personal',
        'custom' => 'Custom Pakaian',
        'uniform' => 'Seragam / Komunitas',
        'reseller' => 'Reseller / Brand',
        'partnership' => 'Kerja Sama',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(FashionCollection::class, 'collection_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? 'Baru';
    }

    public function getNeedTypeLabelAttribute(): string
    {
        return self::NEED_TYPES[$this->need_type] ?? ($this->need_type ?: '-');
    }

    public function getWhatsappUrlAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->phone);

        if (str_starts_with($phone, '0')) {
            $phone = '62'.substr($phone, 1);
        }

        $message = "Halo {$this->name}, kami dari Bendo Jaya.\n\n";
        $message .= 'Terima kasih sudah mengirim inquiry untuk koleksi ';
        $message .= $this->collection?->name ? "\"{$this->collection->name}\"." : 'Bendo Jaya.';
        $message .= "\n\nApakah masih bisa kami bantu konsultasikan kebutuhannya?";

        return 'https://wa.me/'.$phone.'?text='.rawurlencode($message);
    }
}
