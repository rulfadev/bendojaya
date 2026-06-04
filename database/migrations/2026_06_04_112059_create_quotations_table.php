<?php

use App\Models\CollectionInquiry;
use App\Models\PartnershipInquiry;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->nullable()->nullOnDelete();
            $table->foreignIdFor(CollectionInquiry::class)->nullable()->nullOnDelete();
            $table->foreignIdFor(PartnershipInquiry::class)->nullable()->nullOnDelete();

            $table->string('quotation_number')->unique();
            $table->string('title')->nullable();

            $table->string('client_name');
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->date('quotation_date')->nullable();
            $table->date('valid_until')->nullable();

            $table->string('status', 30)->default('draft');

            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);

            $table->text('notes')->nullable();
            $table->text('terms')->nullable();

            $table->timestamp('sent_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();

            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
