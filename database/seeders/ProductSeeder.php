<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = ProductCategory::query()
            ->pluck('id', 'slug');

        $products = [
            [
                'slug' => 'aluminum-kitchens',
                'category' => null,
                'title' => ['en' => 'Aluminum kitchens', 'ar' => 'مطابخ المينيوم'],
                'image' => 'assets/img/services/kitchens/kitchen-1.webp',
            ],
            [
                'slug' => 'wood-kitchens',
                'category' => 'wood-kitchens',
                'title' => ['en' => 'Wood kitchens', 'ar' => 'مطابخ خشب'],
                'image' => 'assets/img/services/kitchens/kitchen-2.webp',
            ],
            [
                'slug' => 'bedroom',
                'category' => 'bedrooms',
                'title' => ['en' => 'Bedroom', 'ar' => 'غرفة نوم'],
                'image' => 'assets/img/services/cupboards/cupboards-1.webp',
            ],
            [
                'slug' => 'wardrobes',
                'category' => 'wardrobes',
                'title' => ['en' => 'Wardrobes', 'ar' => 'خزائن ملابس'],
                'image' => 'assets/img/services/cupboards/cupboards-2.webp',
            ],
            [
                'slug' => 'tv-unit',
                'category' => 'tv-units',
                'title' => ['en' => 'TV unit', 'ar' => 'TV نيو'],
                'image' => 'assets/img/services/cupboards/cupboards-3.webp',
            ],
            [
                'slug' => 'laundry-room',
                'category' => 'laundry-rooms',
                'title' => ['en' => 'Laundry room', 'ar' => 'غرفة الغسيل'],
                'image' => 'assets/img/services/laundromats/Laundromats-1.webp',
            ],
            [
                'slug' => 'washbasins',
                'category' => 'washbasins',
                'title' => ['en' => 'Washbasins', 'ar' => 'مغاسل'],
                'image' => 'assets/img/services/laundromats/Laundromats-2.webp',
            ],
            [
                'slug' => 'bookshelf',
                'category' => 'bookshelf',
                'title' => ['en' => 'Bookshelf', 'ar' => 'مكتبة'],
                'image' => 'assets/img/services/cupboards/cupboards-4.webp',
            ],
            [
                'slug' => 'desks',
                'category' => 'desks',
                'title' => ['en' => 'Desks & offices', 'ar' => 'مكاتب'],
                'image' => 'assets/img/services/kitchens/kitchen-3.webp',
            ],
            [
                'slug' => 'reception-counter',
                'category' => 'reception-counters',
                'title' => ['en' => 'Reception counter', 'ar' => 'كونتر الاستقبال'],
                'image' => 'assets/img/services/kitchens/kitchen-1.webp',
            ],
            [
                'slug' => 'marble-carving',
                'category' => 'marble-carving',
                'title' => ['en' => 'Marble carving', 'ar' => 'نحت رخام'],
                'image' => 'assets/img/services/laundromats/Laundromats-3.webp',
            ],
            [
                'slug' => 'basins',
                'category' => 'basins',
                'title' => ['en' => 'Basins', 'ar' => 'أحواض'],
                'image' => 'assets/img/services/laundromats/Laundromats-2.webp',
            ],
            [
                'slug' => 'mixers',
                'category' => 'mixers',
                'title' => ['en' => 'Mixers & faucets', 'ar' => 'خلطات'],
                'image' => 'assets/img/services/laundromats/Laundromats-1.webp',
            ],
            [
                'slug' => 'range-hoods',
                'category' => 'range-hoods',
                'title' => ['en' => 'Range hoods', 'ar' => 'هراب'],
                'image' => 'assets/img/services/kitchens/kitchen-2.webp',
            ],
            [
                'slug' => 'appliances',
                'category' => 'appliances',
                'title' => ['en' => 'Appliances', 'ar' => 'الأجهزة'],
                'image' => 'assets/img/services/kitchens/kitchen-3.webp',
            ],
        ];

        foreach ($products as $index => $product) {
            $categorySlug = $product['category'];
            unset($product['category']);

            Product::query()->updateOrCreate(
                ['slug' => $product['slug']],
                array_merge($product, [
                    'product_category_id' => $categoryIds[$categorySlug] ?? null,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ])
            );
        }
    }
}
