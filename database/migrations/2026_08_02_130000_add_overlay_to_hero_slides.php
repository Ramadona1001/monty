<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->string('overlay_color')->default('#000000')->after('background_image');
            $table->unsignedTinyInteger('overlay_opacity')->default(0)->after('overlay_color');
        });
    }

    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn(['overlay_color', 'overlay_opacity']);
        });
    }
};
