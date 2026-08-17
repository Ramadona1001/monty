<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'route_name' => 'home',
                'label' => ['en' => 'Home', 'ar' => 'الصفحة الرئيسية'],
                'sort_order' => 1,
            ],
            [
                'route_name' => 'services',
                'label' => ['en' => 'Services', 'ar' => 'خدماتنا'],
                'sort_order' => 2,
            ],
            [
                'route_name' => 'gallery',
                'label' => ['en' => 'Gallery', 'ar' => 'المعرض'],
                'sort_order' => 3,
            ],
            [
                'route_name' => 'about',
                'label' => ['en' => 'About us', 'ar' => 'عن الشركة'],
                'sort_order' => 4,
            ],
            [
                'route_name' => 'contact',
                'label' => ['en' => 'Contact us', 'ar' => 'تواصل معنا'],
                'sort_order' => 5,
            ],
        ];

        foreach ($items as $item) {
            MenuItem::query()->updateOrCreate(
                ['route_name' => $item['route_name']],
                array_merge($item, ['is_active' => true])
            );
        }
    }
}
