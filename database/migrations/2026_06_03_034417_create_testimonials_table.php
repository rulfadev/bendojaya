<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();

            $table->string('token', 80)->unique();

            $table->string('name', 150)->nullable();
            $table->string('company_name', 180)->nullable();
            $table->string('position', 150)->nullable();
            $table->string('email', 180)->nullable();
            $table->string('phone', 40)->nullable();

            $table->unsignedTinyInteger('rating')->nullable();
            $table->longText('message')->nullable();

            $table->string('photo')->nullable();
            $table->string('logo')->nullable();

            $table->string('status', 30)->default('pending'); // pending, approved, rejected
            $table->boolean('is_featured')->default(false);
            $table->boolean('consent_to_publish')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->timestamps();

            $table->index(['status', 'is_featured']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
