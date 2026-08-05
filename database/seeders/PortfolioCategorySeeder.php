<?php

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['slug' => 'kitchens', 'name' => ['en' => 'Kitchens', 'ar' => 'مطابخ']],
            ['slug' => 'cupboards', 'name' => ['en' => 'Cupboards', 'ar' => 'خزائن']],
            ['slug' => 'laundromats', 'name' => ['en' => 'Laundromats', 'ar' => 'مغاسل']],
        ];

        foreach ($categories as $category) {
            PortfolioCategory::query()->create($category);
        }
    }
}
