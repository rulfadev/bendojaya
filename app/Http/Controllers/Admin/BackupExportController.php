<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\FashionCollection;
use App\Models\Gallery;
use App\Models\MediaAsset;
use App\Models\NavigationMenu;
use App\Models\Page;
use App\Models\Partner;
use App\Models\PartnershipInquiry;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BackupExportController extends Controller
{
    public function index()
    {
        return view('admin.backups.index', [
            'title' => 'Backup & Export Data',
            'subtitle' => 'Download data website dalam format CSV.',
            'exports' => $this->exports(),
        ]);
    }

    public function export(Request $request, string $type): StreamedResponse
    {
        abort_unless(array_key_exists($type, $this->exports()), 404);

        [$filename, $headers, $rows] = $this->dataset($type);

        return response()->streamDownload(function () use ($headers, $rows) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOM agar Excel membaca karakter Indonesia dengan benar.
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($handle, $headers);

            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function exports(): array
    {
        return [
            'articles' => [
                'label' => 'Artikel',
                'description' => 'Export data artikel/blog website.',
                'icon' => 'fa-solid fa-newspaper',
            ],
            'pages' => [
                'label' => 'Custom Page',
                'description' => 'Export halaman custom.',
                'icon' => 'fa-solid fa-file-lines',
            ],
            'collections' => [
                'label' => 'Koleksi',
                'description' => 'Export data koleksi batik.',
                'icon' => 'fa-solid fa-shirt',
            ],
            'galleries' => [
                'label' => 'Gallery',
                'description' => 'Export data gallery.',
                'icon' => 'fa-solid fa-images',
            ],
            'services' => [
                'label' => 'Layanan',
                'description' => 'Export data layanan.',
                'icon' => 'fa-solid fa-sparkles',
            ],
            'partners' => [
                'label' => 'Partner Bisnis',
                'description' => 'Export data brand/partner.',
                'icon' => 'fa-solid fa-handshake',
            ],
            'testimonials' => [
                'label' => 'Testimoni',
                'description' => 'Export data testimoni client.',
                'icon' => 'fa-solid fa-star',
            ],
            'contact_messages' => [
                'label' => 'Pesan Kontak',
                'description' => 'Export pesan masuk dan status follow up.',
                'icon' => 'fa-solid fa-envelope-open-text',
            ],
            'faqs' => [
                'label' => 'FAQ',
                'description' => 'Export data pertanyaan FAQ.',
                'icon' => 'fa-solid fa-circle-question',
            ],
            'navigation_menus' => [
                'label' => 'Menu Navigasi',
                'description' => 'Export menu header/footer.',
                'icon' => 'fa-solid fa-bars-staggered',
            ],
            'media_assets' => [
                'label' => 'Media Library',
                'description' => 'Export daftar file media.',
                'icon' => 'fa-solid fa-photo-film',
            ],
            'collection_inquiries' => [
                'label' => 'Inquiry Koleksi',
                'description' => 'Export data inquiry koleksi.',
                'icon' => 'fa-solid fa-clipboard-question',
            ],
            'partnership_inquiries' => [
                'label' => 'Inquiry Kerja Sama',
                'description' => 'Export data inquiry kerja sama.',
                'icon' => 'fa-solid fa-handshake-angle',
            ],
            'quotations' => [
                'label' => 'Quotation',
                'description' => 'Export data penawaran harga.',
                'icon' => 'fa-solid fa-file-invoice-dollar',
            ],
        ];
    }

    private function dataset(string $type): array
    {
        return match ($type) {
            'articles' => [
                $this->filename('articles'),
                [
                    'ID',
                    'Title',
                    'Slug',
                    'Category',
                    'Excerpt',
                    'Featured Image',
                    'Meta Title',
                    'Meta Description',
                    'Is Featured',
                    'Is Active',
                    'Sort Order',
                    'Published At',
                    'Created At',
                    'Updated At',
                ],
                Article::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->title,
                    $item->slug,
                    $item->category,
                    $item->excerpt,
                    $item->featured_image,
                    $item->meta_title,
                    $item->meta_description,
                    $this->yesNo($item->is_featured),
                    $this->yesNo($item->is_active),
                    $item->sort_order,
                    $this->date($item->published_at),
                    $this->date($item->created_at),
                    $this->date($item->updated_at),
                ]),
            ],

            'pages' => [
                $this->filename('pages'),
                [
                    'ID',
                    'Title',
                    'Slug',
                    'Template',
                    'Meta Title',
                    'Meta Description',
                    'Is Active',
                    'Sort Order',
                    'Created At',
                    'Updated At',
                ],
                Page::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->title,
                    $item->slug,
                    $item->template ?? null,
                    $item->meta_title ?? null,
                    $item->meta_description ?? null,
                    $this->yesNo($item->is_active),
                    $item->sort_order ?? 0,
                    $this->date($item->created_at),
                    $this->date($item->updated_at),
                ]),
            ],

            'collections' => [
                $this->filename('collections'),
                [
                    'ID',
                    'Name',
                    'Slug',
                    'Category',
                    'Short Description',
                    'Material',
                    'Color Palette',
                    'Size Info',
                    'Main Image',
                    'Is Featured',
                    'Is Active',
                    'Sort Order',
                    'Created At',
                    'Updated At',
                ],
                FashionCollection::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->name,
                    $item->slug,
                    $item->category,
                    $item->short_description,
                    $item->material,
                    $item->color_palette,
                    $item->size_info,
                    $item->main_image,
                    $this->yesNo($item->is_featured),
                    $this->yesNo($item->is_active),
                    $item->sort_order,
                    $this->date($item->created_at),
                    $this->date($item->updated_at),
                ]),
            ],

            'galleries' => [
                $this->filename('galleries'),
                [
                    'ID',
                    'Title',
                    'Slug',
                    'Category',
                    'Caption',
                    'Image',
                    'Is Featured',
                    'Is Active',
                    'Sort Order',
                    'Created At',
                    'Updated At',
                ],
                Gallery::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->title,
                    $item->slug,
                    $item->category,
                    $item->caption,
                    $item->image,
                    $this->yesNo($item->is_featured),
                    $this->yesNo($item->is_active),
                    $item->sort_order,
                    $this->date($item->created_at),
                    $this->date($item->updated_at),
                ]),
            ],

            'services' => [
                $this->filename('services'),
                [
                    'ID',
                    'Title',
                    'Slug',
                    'Short Description',
                    'Image',
                    'Show Button',
                    'Button Label',
                    'Button URL',
                    'Is Featured',
                    'Is Active',
                    'Sort Order',
                    'Created At',
                    'Updated At',
                ],
                Service::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->title,
                    $item->slug,
                    $item->short_description,
                    $item->image,
                    $this->yesNo($item->show_button ?? false),
                    $item->button_label ?? null,
                    $item->button_url ?? null,
                    $this->yesNo($item->is_featured),
                    $this->yesNo($item->is_active),
                    $item->sort_order,
                    $this->date($item->created_at),
                    $this->date($item->updated_at),
                ]),
            ],

            'partners' => [
                $this->filename('partners'),
                [
                    'ID',
                    'Name',
                    'Slug',
                    'Category',
                    'Description',
                    'Website URL',
                    'Instagram URL',
                    'WhatsApp',
                    'Logo',
                    'Is Featured',
                    'Is Active',
                    'Sort Order',
                    'Created At',
                    'Updated At',
                ],
                Partner::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->name,
                    $item->slug,
                    $item->category,
                    $item->description,
                    $item->website_url,
                    $item->instagram_url,
                    $item->whatsapp_number,
                    $item->logo,
                    $this->yesNo($item->is_featured),
                    $this->yesNo($item->is_active),
                    $item->sort_order,
                    $this->date($item->created_at),
                    $this->date($item->updated_at),
                ]),
            ],

            'testimonials' => [
                $this->filename('testimonials'),
                [
                    'ID',
                    'Name',
                    'Company Name',
                    'Position',
                    'Email',
                    'Phone',
                    'Rating',
                    'Message',
                    'Status',
                    'Is Featured',
                    'Consent To Publish',
                    'Submitted At',
                    'Approved At',
                    'Created At',
                    'Updated At',
                ],
                Testimonial::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->name,
                    $item->company_name,
                    $item->position,
                    $item->email,
                    $item->phone,
                    $item->rating,
                    $item->message,
                    $item->status,
                    $this->yesNo($item->is_featured),
                    $this->yesNo($item->consent_to_publish),
                    $this->date($item->submitted_at),
                    $this->date($item->approved_at),
                    $this->date($item->created_at),
                    $this->date($item->updated_at),
                ]),
            ],

            'contact_messages' => [
                $this->filename('contact-messages'),
                [
                    'ID',
                    'Name',
                    'Email',
                    'Phone',
                    'Subject',
                    'Message',
                    'Status',
                    'Follow Up Note',
                    'Is Read',
                    'Read At',
                    'Contacted At',
                    'Completed At',
                    'Source URL',
                    'Created At',
                    'Updated At',
                ],
                ContactMessage::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->name,
                    $item->email,
                    $item->phone,
                    $item->subject,
                    $item->message,
                    $item->status ?? null,
                    $item->follow_up_note ?? null,
                    $this->yesNo($item->is_read),
                    $this->date($item->read_at),
                    $this->date($item->contacted_at ?? null),
                    $this->date($item->completed_at ?? null),
                    $item->source_url,
                    $this->date($item->created_at),
                    $this->date($item->updated_at),
                ]),
            ],

            'faqs' => [
                $this->filename('faqs'),
                [
                    'ID',
                    'Question',
                    'Answer',
                    'Category',
                    'Is Featured',
                    'Is Active',
                    'Sort Order',
                    'Created At',
                    'Updated At',
                ],
                Faq::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->question,
                    $item->answer,
                    $item->category,
                    $this->yesNo($item->is_featured),
                    $this->yesNo($item->is_active),
                    $item->sort_order,
                    $this->date($item->created_at),
                    $this->date($item->updated_at),
                ]),
            ],

            'navigation_menus' => [
                $this->filename('navigation-menus'),
                [
                    'ID',
                    'Label',
                    'Type',
                    'URL',
                    'Anchor',
                    'Position',
                    'Target',
                    'Is Active',
                    'Sort Order',
                    'Created At',
                    'Updated At',
                ],
                NavigationMenu::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->label,
                    $item->type,
                    $item->url,
                    $item->anchor,
                    $item->position,
                    $item->target,
                    $this->yesNo($item->is_active),
                    $item->sort_order,
                    $this->date($item->created_at),
                    $this->date($item->updated_at),
                ]),
            ],

            'media_assets' => [
                $this->filename('media-assets'),
                [
                    'ID',
                    'Title',
                    'Alt Text',
                    'Folder',
                    'Disk',
                    'Path',
                    'URL',
                    'Original Name',
                    'Mime Type',
                    'Size',
                    'Created At',
                    'Updated At',
                ],
                MediaAsset::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->title,
                    $item->alt_text,
                    $item->folder,
                    $item->disk,
                    $item->path,
                    $item->url,
                    $item->original_name,
                    $item->mime_type,
                    $item->size,
                    $this->date($item->created_at),
                    $this->date($item->updated_at),
                ]),
            ],

            'collection_inquiries' => [
                $this->filename('collection-inquiries'),
                [
                    'ID',
                    'Collection',
                    'Name',
                    'Email',
                    'Phone',
                    'Size',
                    'Quantity',
                    'Need Type',
                    'Message',
                    'Status',
                    'Follow Up Note',
                    'Contacted At',
                    'Completed At',
                    'Created At',
                ],
                CollectionInquiry::query()->with('collection')->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->collection?->name,
                    $item->name,
                    $item->email,
                    $item->phone,
                    $item->size,
                    $item->quantity,
                    $item->need_type,
                    $item->message,
                    $item->status,
                    $item->follow_up_note,
                    $this->date($item->contacted_at),
                    $this->date($item->completed_at),
                    $this->date($item->created_at),
                ]),
            ],

            'partnership_inquiries' => [
                $this->filename('partnership-inquiries'),
                [
                    'ID',
                    'Company Name',
                    'PIC Name',
                    'Email',
                    'Phone',
                    'Partnership Type',
                    'Estimated Quantity',
                    'Budget Range',
                    'Deadline Date',
                    'Message',
                    'Status',
                    'Follow Up Note',
                    'Contacted At',
                    'Completed At',
                    'Created At',
                ],
                PartnershipInquiry::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->company_name,
                    $item->pic_name,
                    $item->email,
                    $item->phone,
                    $item->partnership_type,
                    $item->estimated_quantity,
                    $item->budget_range,
                    $this->date($item->deadline_date),
                    $item->message,
                    $item->status,
                    $item->follow_up_note,
                    $this->date($item->contacted_at),
                    $this->date($item->completed_at),
                    $this->date($item->created_at),
                ]),
            ],

            'quotations' => [
                $this->filename('quotations'),
                [
                    'ID',
                    'Quotation Number',
                    'Title',
                    'Client Name',
                    'Company Name',
                    'Email',
                    'Phone',
                    'Status',
                    'Subtotal',
                    'Discount',
                    'Tax',
                    'Total',
                    'Quotation Date',
                    'Valid Until',
                    'Created At',
                ],
                Quotation::query()->latest()->get()->map(fn ($item) => [
                    $item->id,
                    $item->quotation_number,
                    $item->title,
                    $item->client_name,
                    $item->company_name,
                    $item->email,
                    $item->phone,
                    $item->status,
                    $item->subtotal,
                    $item->discount_amount,
                    $item->tax_amount,
                    $item->total_amount,
                    $this->date($item->quotation_date),
                    $this->date($item->valid_until),
                    $this->date($item->created_at),
                ]),
            ],

            default => abort(404),
        };
    }

    private function filename(string $name): string
    {
        return Str::slug(config('app.name', 'bendo-jaya').'-'.$name.'-'.now()->format('Y-m-d-His')).'.csv';
    }

    private function date($value): ?string
    {
        return $value ? $value->format('Y-m-d H:i:s') : null;
    }

    private function yesNo($value): string
    {
        return $value ? 'Ya' : 'Tidak';
    }
}
