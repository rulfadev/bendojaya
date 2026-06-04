<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->string('public_token', 80)->nullable()->unique()->after('quotation_number');
            $table->timestamp('viewed_at')->nullable()->after('rejected_at');
            $table->timestamp('client_responded_at')->nullable()->after('viewed_at');
        });
    }

    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn([
                'public_token',
                'viewed_at',
                'client_responded_at',
            ]);
        });
    }
};
