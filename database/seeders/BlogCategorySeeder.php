<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        BlogCategory::query()->create([
            'slug' => 'kitchen-tips',
            'name' => [
                'en' => 'Kitchen Tips',
                'ar' => 'نصائح المطبخ',
            ],
            'description' => [
                'en' => 'Tips and guides for kitchen design and maintenance.',
                'ar' => 'نصائح وإرشادات لتصميم وصيانة المطبخ.',
            ],
        ]);

        BlogCategory::query()->create([
            'slug' => 'company-news',
            'name' => [
                'en' => 'Company News',
                'ar' => 'أخبار الشركة',
            ],
            'description' => [
                'en' => 'Latest news and updates from Monty.',
                'ar' => 'آخر الأخبار والتحديثات من مونتي.',
            ],
        ]);
    }
}
