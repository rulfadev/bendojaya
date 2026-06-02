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
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('show_button')->default(true)->after('sort_order');
            $table->string('button_label', 120)->nullable()->after('show_button');
            $table->string('button_url')->nullable()->after('button_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['show_button', 'button_label', 'button_url']);
        });
    }
};
