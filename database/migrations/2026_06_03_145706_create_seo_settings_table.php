<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();

            $table->string('default_meta_title')->nullable();
            $table->text('default_meta_description')->nullable();
            $table->text('default_meta_keywords')->nullable();
            $table->string('default_og_image')->nullable();

            $table->boolean('allow_indexing')->default(true);
            $table->boolean('enable_sitemap')->default(true);
            $table->boolean('enable_json_ld')->default(true);
            $table->boolean('enable_llms_txt')->default(true);

            $table->string('canonical_base_url')->nullable();

            $table->string('google_site_verification')->nullable();
            $table->string('bing_site_verification')->nullable();

            $table->string('organization_name')->nullable();
            $table->string('organization_logo')->nullable();
            $table->string('organization_type')->default('Organization');
            $table->string('same_as_instagram')->nullable();
            $table->string('same_as_tiktok')->nullable();

            $table->text('robots_extra_rules')->nullable();
            $table->text('llms_txt_content')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
