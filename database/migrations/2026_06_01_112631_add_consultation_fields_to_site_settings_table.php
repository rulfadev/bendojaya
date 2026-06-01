<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('consultation_label')->nullable()->after('whatsapp_number');
            $table->string('consultation_url')->nullable()->after('consultation_label');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'consultation_label',
                'consultation_url',
            ]);
        });
    }
};
