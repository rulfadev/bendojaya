<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['company_name', 'pic_name', 'email', 'phone', 'partnership_type', 'estimated_quantity', 'budget_range', 'deadline_date', 'message', 'status', 'follow_up_note', 'contacted_at', 'completed_at', 'source_url', 'ip_address', 'user_agent'])]

class PartnershipInquiry extends Model
{
    protected function casts(): array
    {
        return [
            'estimated_quantity' => 'integer',
            'deadline_date' => 'date',
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

    public const PARTNERSHIP_TYPES = [
        'custom_uniform' => 'Custom Seragam',
        'brand_production' => 'Produksi Brand',
        'reseller' => 'Reseller',
        'event_community' => 'Event / Komunitas',
        'company_institution' => 'Instansi / Perusahaan',
        'other' => 'Lainnya',
    ];

    public const BUDGET_RANGES = [
        '< 5 juta' => '< 5 juta',
        '5 - 10 juta' => '5 - 10 juta',
        '10 - 25 juta' => '10 - 25 juta',
        '25 - 50 juta' => '25 - 50 juta',
        '> 50 juta' => '> 50 juta',
        'discuss' => 'Diskusi dahulu',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? 'Baru';
    }

    public function getPartnershipTypeLabelAttribute(): string
    {
        return self::PARTNERSHIP_TYPES[$this->partnership_type] ?? ($this->partnership_type ?: '-');
    }

    public function getWhatsappUrlAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->phone);

        if (str_starts_with($phone, '0')) {
            $phone = '62'.substr($phone, 1);
        }

        $message = "Halo {$this->pic_name}, kami dari Bendo Jaya.\n\n";
        $message .= 'Terima kasih sudah mengirim inquiry kerja sama';
        $message .= $this->company_name ? " untuk {$this->company_name}." : '.';
        $message .= "\n\nApakah masih bisa kami bantu konsultasikan kebutuhan kerja samanya?";

        return 'https://wa.me/'.$phone.'?text='.rawurlencode($message);
    }
}
