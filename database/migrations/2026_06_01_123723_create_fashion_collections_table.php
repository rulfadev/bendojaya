<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fashion_collections', function (Blueprint $table) {
            $table->id();

            $table->string('name', 180);
            $table->string('slug', 220)->unique();
            $table->string('category', 150)->nullable();

            $table->string('main_image')->nullable();

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->string('material', 150)->nullable();
            $table->string('color_palette', 150)->nullable();
            $table->string('size_info', 150)->nullable();

            $table->boolean('is_featured')->default(true);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['is_active', 'is_featured']);
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fashion_collections');
    }
};
