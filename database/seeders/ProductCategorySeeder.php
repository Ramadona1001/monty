<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'slug' => 'wood-kitchens',
                'name' => ['en' => 'Wood kitchens', 'ar' => 'مطابخ خشب'],
            ],
            [
                'slug' => 'appliances',
                'name' => ['en' => 'Appliances section', 'ar' => 'قسم الاجهزه'],
            ],
            [
                'slug' => 'basins',
                'name' => ['en' => 'Basins section', 'ar' => 'قسم الاحواض'],
            ],
            [
                'slug' => 'mixers',
                'name' => ['en' => 'Mixers section', 'ar' => 'قسم الخلطات'],
            ],
            [
                'slug' => 'washbasins',
                'name' => ['en' => 'Washbasins section', 'ar' => 'قسم المغاسل'],
            ],
            [
                'slug' => 'bookshelf',
                'name' => ['en' => 'Bookshelf section', 'ar' => 'قسم المكتبة'],
            ],
            [
                'slug' => 'wardrobes',
                'name' => ['en' => 'Wardrobes section', 'ar' => 'قسم خزائن الملابس'],
            ],
            [
                'slug' => 'bedrooms',
                'name' => ['en' => 'Bedrooms section', 'ar' => 'قسم غرف النوم'],
            ],
            [
                'slug' => 'laundry-rooms',
                'name' => ['en' => 'Laundry rooms section', 'ar' => 'قسم غرف الغسيل'],
            ],
            [
                'slug' => 'reception-counters',
                'name' => ['en' => 'Reception counters section', 'ar' => 'قسم كونتر الاستقبال'],
            ],
            [
                'slug' => 'desks',
                'name' => ['en' => 'Desks section', 'ar' => 'قسم المكاتب'],
            ],
            [
                'slug' => 'marble-carving',
                'name' => ['en' => 'Marble carving section', 'ar' => 'قسم نحت الرخام'],
            ],
            [
                'slug' => 'tv-units',
                'name' => ['en' => 'TV unit section', 'ar' => 'قسم نيو TV'],
            ],
            [
                'slug' => 'range-hoods',
                'name' => ['en' => 'Range hoods section', 'ar' => 'قسم هراب'],
            ],
        ];

        foreach ($categories as $index => $category) {
            ProductCategory::query()->updateOrCreate(
                ['slug' => $category['slug']],
                array_merge($category, [
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ])
            );
        }
    }
}
