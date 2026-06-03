<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->boolean('show_faq')->default(true)->after('articles_description');
            $table->string('faq_eyebrow')->nullable()->after('show_faq');
            $table->string('faq_title')->nullable()->after('faq_eyebrow');
            $table->text('faq_description')->nullable()->after('faq_title');
        });
    }

    public function down(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->dropColumn([
                'show_faq',
                'faq_eyebrow',
                'faq_title',
                'faq_description',
            ]);
        });
    }
};
