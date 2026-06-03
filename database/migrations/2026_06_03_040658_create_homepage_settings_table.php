<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();

            $table->boolean('show_hero')->default(true);
            $table->string('hero_eyebrow')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_primary_label')->nullable();
            $table->string('hero_primary_url')->nullable();
            $table->string('hero_secondary_label')->nullable();
            $table->string('hero_secondary_url')->nullable();

            $table->boolean('show_value_strip')->default(true);
            $table->json('value_items')->nullable();

            $table->boolean('show_about')->default(true);
            $table->string('about_eyebrow')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_image')->nullable();
            $table->boolean('show_about_button')->default(true);
            $table->string('about_button_label')->nullable();
            $table->string('about_button_url')->nullable();

            $table->boolean('show_services')->default(true);
            $table->string('services_eyebrow')->nullable();
            $table->string('services_title')->nullable();
            $table->text('services_description')->nullable();

            $table->boolean('show_collections')->default(true);
            $table->string('collections_eyebrow')->nullable();
            $table->string('collections_title')->nullable();
            $table->text('collections_description')->nullable();

            $table->boolean('show_gallery')->default(true);
            $table->string('gallery_eyebrow')->nullable();
            $table->string('gallery_title')->nullable();
            $table->text('gallery_description')->nullable();

            $table->boolean('show_partners')->default(true);
            $table->string('partners_eyebrow')->nullable();
            $table->string('partners_title')->nullable();
            $table->text('partners_description')->nullable();
            $table->string('partners_image')->nullable();

            $table->boolean('show_testimonials')->default(true);
            $table->string('testimonials_eyebrow')->nullable();
            $table->string('testimonials_title')->nullable();
            $table->text('testimonials_description')->nullable();

            $table->boolean('show_articles')->default(true);
            $table->string('articles_eyebrow')->nullable();
            $table->string('articles_title')->nullable();
            $table->text('articles_description')->nullable();

            $table->boolean('show_cta')->default(true);
            $table->string('cta_eyebrow')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_button_label')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->string('cta_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_settings');
    }
};
