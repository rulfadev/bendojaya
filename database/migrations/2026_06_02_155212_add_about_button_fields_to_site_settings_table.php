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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->boolean('show_about_button')->default(true)->after('consultation_url');
            $table->string('about_button_label', 120)->nullable()->after('show_about_button');
            $table->string('about_button_url')->nullable()->after('about_button_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['show_about_button', 'about_button_label', 'about_button_url']);
        });
    }
};
