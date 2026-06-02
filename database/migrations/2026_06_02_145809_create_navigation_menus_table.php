<?php

use App\Models\Article;
use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigation_menus', function (Blueprint $table) {
            $table->id();

            $table->string('label', 100);
            $table->string('type', 30)->default('custom'); // custom, page, article, anchor
            $table->string('url')->nullable();
            $table->foreignIdFor(Page::class)->nullable()->nullOnDelete();
            $table->foreignIdFor(Article::class)->nullable()->nullOnDelete();
            $table->string('anchor', 120)->nullable();

            $table->string('position', 30)->default('header'); // header, footer, both
            $table->string('target', 20)->default('_self'); // _self, _blank

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigation_menus');
    }
};
