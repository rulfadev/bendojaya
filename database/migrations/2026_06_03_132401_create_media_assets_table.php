<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_assets', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->nullable()->nullOnDelete();

            $table->string('title')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('folder')->nullable();

            $table->string('disk')->default('public');
            $table->string('path');
            $table->string('original_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->default(0);

            $table->timestamps();

            $table->index(['folder', 'mime_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_assets');
    }
};
