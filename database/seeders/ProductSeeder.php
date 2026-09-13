<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'slug' => 'aluminum-kitchens',
                'title' => ['en' => 'Aluminum kitchens', 'ar' => 'مطابخ المينيوم'],
                'image' => 'assets/img/services/kitchens/kitchen-1.webp',
            ],
            [
                'slug' => 'wood-kitchens',
                'title' => ['en' => 'Wood kitchens', 'ar' => 'مطابخ خشب'],
                'image' => 'assets/img/services/kitchens/kitchen-2.webp',
            ],
            [
                'slug' => 'bedroom',
                'title' => ['en' => 'Bedroom', 'ar' => 'غرفة نوم'],
                'image' => 'assets/img/services/cupboards/cupboards-1.webp',
            ],
            [
                'slug' => 'wardrobes',
                'title' => ['en' => 'Wardrobes', 'ar' => 'خزائن ملابس'],
                'image' => 'assets/img/services/cupboards/cupboards-2.webp',
            ],
            [
                'slug' => 'tv-unit',
                'title' => ['en' => 'TV unit', 'ar' => 'TV نيو'],
                'image' => 'assets/img/services/cupboards/cupboards-3.webp',
            ],
            [
                'slug' => 'laundry-room',
                'title' => ['en' => 'Laundry room', 'ar' => 'غرفة الغسيل'],
                'image' => 'assets/img/services/laundromats/Laundromats-1.webp',
            ],
            [
                'slug' => 'washbasins',
                'title' => ['en' => 'Washbasins', 'ar' => 'مغاسل'],
                'image' => 'assets/img/services/laundromats/Laundromats-2.webp',
            ],
            [
                'slug' => 'bookshelf',
                'title' => ['en' => 'Bookshelf', 'ar' => 'مكتبة'],
                'image' => 'assets/img/services/cupboards/cupboards-4.webp',
            ],
            [
                'slug' => 'desks',
                'title' => ['en' => 'Desks & offices', 'ar' => 'مكاتب'],
                'image' => 'assets/img/services/kitchens/kitchen-3.webp',
            ],
            [
                'slug' => 'reception-counter',
                'title' => ['en' => 'Reception counter', 'ar' => 'كونتر الاستقبال'],
                'image' => 'assets/img/services/kitchens/kitchen-1.webp',
            ],
            [
                'slug' => 'marble-carving',
                'title' => ['en' => 'Marble carving', 'ar' => 'نحت رخام'],
                'image' => 'assets/img/services/laundromats/Laundromats-3.webp',
            ],
            [
                'slug' => 'basins',
                'title' => ['en' => 'Basins', 'ar' => 'أحواض'],
                'image' => 'assets/img/services/laundromats/Laundromats-2.webp',
            ],
            [
                'slug' => 'mixers',
                'title' => ['en' => 'Mixers & faucets', 'ar' => 'خلطات'],
                'image' => 'assets/img/services/laundromats/Laundromats-1.webp',
            ],
            [
                'slug' => 'range-hoods',
                'title' => ['en' => 'Range hoods', 'ar' => 'هراب'],
                'image' => 'assets/img/services/kitchens/kitchen-2.webp',
            ],
            [
                'slug' => 'appliances',
                'title' => ['en' => 'Appliances', 'ar' => 'الأجهزة'],
                'image' => 'assets/img/services/kitchens/kitchen-3.webp',
            ],
        ];

        foreach ($products as $index => $product) {
            Product::query()->updateOrCreate(
                ['slug' => $product['slug']],
                array_merge($product, [
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ])
            );
        }
    }
}
