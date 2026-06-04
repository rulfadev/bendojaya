<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partnership_inquiries', function (Blueprint $table) {
            $table->id();

            $table->string('company_name')->nullable();
            $table->string('pic_name');
            $table->string('email')->nullable();
            $table->string('phone');

            $table->string('partnership_type')->nullable();
            $table->unsignedInteger('estimated_quantity')->nullable();
            $table->string('budget_range')->nullable();
            $table->date('deadline_date')->nullable();

            $table->text('message')->nullable();

            $table->string('status', 30)->default('new');
            $table->text('follow_up_note')->nullable();
            $table->timestamp('contacted_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->string('source_url')->nullable();
            $table->string('ip_address', 80)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('partnership_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partnership_inquiries');
    }
};
