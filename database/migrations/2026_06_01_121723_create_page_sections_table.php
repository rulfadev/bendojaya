<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Page::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->string('type', 80)->default('text');
            $table->string('eyebrow', 150)->nullable();
            $table->string('title', 220)->nullable();
            $table->text('subtitle')->nullable();
            $table->longText('content')->nullable();

            $table->string('image')->nullable();
            $table->string('image_position', 20)->default('right');

            $table->string('button_label', 120)->nullable();
            $table->string('button_url')->nullable();

            $table->json('settings')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['page_id', 'type', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
