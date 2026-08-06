<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_request_types', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->json('name');
            $table->json('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_request_type_id')->constrained()->cascadeOnDelete();
            $table->string('customer_name');
            $table->string('phone');
            $table->text('notes')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
        Schema::dropIfExists('service_request_types');
    }
};
