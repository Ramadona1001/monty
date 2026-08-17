<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->json('individuals_button_text')->nullable()->after('button_text');
            $table->json('projects_button_text')->nullable()->after('individuals_button_text');
        });

        foreach (DB::table('hero_slides')->orderBy('id')->get() as $slide) {
            DB::table('hero_slides')->where('id', $slide->id)->update([
                'individuals_button_text' => $slide->button_text,
                'projects_button_text' => json_encode([
                    'en' => 'For projects',
                    'ar' => 'للمشاريع',
                ]),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn(['individuals_button_text', 'projects_button_text']);
        });
    }
};
