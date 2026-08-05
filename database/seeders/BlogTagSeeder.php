<?php

namespace Database\Seeders;

use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['slug' => 'kitchens', 'name' => ['en' => 'Kitchens', 'ar' => 'مطابخ']],
            ['slug' => 'cabinets', 'name' => ['en' => 'Cabinets', 'ar' => 'خزائن']],
            ['slug' => 'wood', 'name' => ['en' => 'Wood', 'ar' => 'خشب']],
        ];

        foreach ($tags as $tag) {
            BlogTag::query()->create($tag);
        }
    }
}
