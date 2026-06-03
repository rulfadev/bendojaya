<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('status', 30)->default('new')->after('read_at');
            $table->text('follow_up_note')->nullable()->after('status');
            $table->timestamp('contacted_at')->nullable()->after('follow_up_note');
            $table->timestamp('completed_at')->nullable()->after('contacted_at');

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropColumn([
                'status',
                'follow_up_note',
                'contacted_at',
                'completed_at',
            ]);
        });
    }
};
