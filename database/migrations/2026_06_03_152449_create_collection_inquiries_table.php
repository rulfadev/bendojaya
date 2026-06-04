<?php

use App\Models\FashionCollection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collection_inquiries', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(FashionCollection::class, 'collection_id')
                ->nullable()
                ->nullOnDelete();

            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('size')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->string('need_type')->nullable();
            $table->text('message')->nullable();

            $table->string('status', 30)->default('new');
            $table->text('follow_up_note')->nullable();
            $table->timestamp('contacted_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->string('source_url')->nullable();
            $table->string('ip_address', 80)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collection_inquiries');
    }
};
