<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->nullable()->nullOnDelete();

            $table->string('action', 50);
            $table->nullableMorphs('subject');

            $table->string('description')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();

            $table->string('ip_address', 80)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('url')->nullable();
            $table->string('method', 20)->nullable();

            $table->timestamps();

            $table->index(['action', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
