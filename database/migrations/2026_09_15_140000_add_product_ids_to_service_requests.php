<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->json('product_ids')->nullable()->after('is_all_products');
        });

        foreach (DB::table('service_requests')->orderBy('id')->get() as $request) {
            $productIds = null;

            if ($request->is_all_products) {
                $productIds = DB::table('products')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->limit(10)
                    ->pluck('id')
                    ->values()
                    ->all();
            } elseif ($request->product_id) {
                $productIds = [(int) $request->product_id];
            }

            if ($productIds !== null) {
                DB::table('service_requests')
                    ->where('id', $request->id)
                    ->update(['product_ids' => json_encode($productIds)]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn('product_ids');
        });
    }
};
