<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->after('customer_type')->constrained()->nullOnDelete();
            $table->boolean('is_all_products')->default(false)->after('product_id');
        });
    }

    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropConstrainedForeignId('product_id');
            $table->dropColumn('is_all_products');
        });
    }
};
