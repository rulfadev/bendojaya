<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->boolean('is_maintenance_mode')->default(false)->after('favicon');
            $table->string('maintenance_title')->nullable()->after('is_maintenance_mode');
            $table->text('maintenance_description')->nullable()->after('maintenance_title');
            $table->string('maintenance_image')->nullable()->after('maintenance_description');

            $table->boolean('allow_search_indexing')->default(true)->after('meta_keywords');
            $table->string('site_author')->nullable()->after('allow_search_indexing');
            $table->string('default_og_image')->nullable()->after('site_author');
            $table->string('google_site_verification')->nullable()->after('default_og_image');
            $table->string('bing_site_verification')->nullable()->after('google_site_verification');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'is_maintenance_mode',
                'maintenance_title',
                'maintenance_description',
                'maintenance_image',
                'allow_search_indexing',
                'site_author',
                'default_og_image',
                'google_site_verification',
                'bing_site_verification',
            ]);
        });
    }
};
