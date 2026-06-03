<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'label', 'message', 'is_active', 'sort_order'])]
class WhatsappTemplate extends Model
{
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public const KEYS = [
        'default' => 'Default / Umum',
        'hero' => 'Hero / CTA',
        'service' => 'Layanan',
        'collection' => 'Detail Koleksi',
        'partnership' => 'Kerja Sama',
        'page' => 'Custom Page',
    ];

    public static function defaultMessages(): array
    {
        return [
            'default' => "Halo {site_name}, saya ingin konsultasi.\n\nHalaman: {current_url}",
            'hero' => "Halo {site_name}, saya tertarik dengan Bendo Jaya Batik Fashion.\nSaya ingin konsultasi kebutuhan batik/custom.\n\nHalaman: {current_url}",
            'service' => "Halo {site_name}, saya ingin konsultasi layanan {service_title}.\n\nHalaman: {current_url}",
            'collection' => "Halo {site_name}, saya tertarik dengan koleksi {collection_name}.\nKategori: {collection_category}\n\nApakah bisa konsultasi ukuran, bahan, dan custom?\n\nHalaman: {current_url}",
            'partnership' => "Halo {site_name}, saya ingin mengajukan kerja sama dengan Bendo Jaya.\n\nKebutuhan saya:\n- Nama brand/perusahaan:\n- Jenis kerja sama:\n- Jumlah kebutuhan:\n\nHalaman: {current_url}",
            'page' => "Halo {site_name}, saya ingin bertanya tentang {page_title}.\n\nHalaman: {current_url}",
        ];
    }
}
