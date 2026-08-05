<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_settings', function (Blueprint $table) {
            $table->json('services_subheading')->nullable()->after('home_body');
            $table->json('services_heading')->nullable()->after('services_subheading');
            $table->json('services_intro')->nullable()->after('services_heading');
            $table->json('progress_subheading')->nullable()->after('services_intro');
            $table->json('progress_heading')->nullable()->after('progress_subheading');
        });
    }

    public function down(): void
    {
        Schema::table('about_settings', function (Blueprint $table) {
            $table->dropColumn([
                'services_subheading',
                'services_heading',
                'services_intro',
                'progress_subheading',
                'progress_heading',
            ]);
        });
    }
};
