<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioImage;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $category = PortfolioCategory::query()->where('slug', 'kitchens')->first();

        $portfolio = Portfolio::query()->create([
            'portfolio_category_id' => $category?->id,
            'slug' => 'modern-wooden-kitchen-dammam',
            'title' => [
                'en' => 'Modern Wooden Kitchen - Dammam',
                'ar' => 'مطبخ خشبي عصري - الدمام',
            ],
            'description' => [
                'en' => 'A custom modern kitchen designed and installed for a residential project in Dammam.',
                'ar' => 'مطبخ عصري مخصص تم تصميمه وتركيبه لمشروع سكني في الدمام.',
            ],
            'client' => [
                'en' => 'Private Client',
                'ar' => 'عميل خاص',
            ],
            'project_date' => now()->subMonths(3)->toDateString(),
            'technologies' => [
                'en' => ['Red beech', 'MDF', 'Custom fittings'],
                'ar' => ['زان أحمر', 'MDF', 'تجهيزات مخصصة'],
            ],
            'featured_image' => 'assets/img/services/kitchens/kitchen-2.webp',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        foreach ([
            'assets/img/services/kitchens/kitchen-1.webp',
            'assets/img/services/kitchens/kitchen-2.webp',
            'assets/img/services/kitchens/kitchen-3.webp',
        ] as $index => $image) {
            PortfolioImage::query()->create([
                'portfolio_id' => $portfolio->id,
                'image_path' => $image,
                'sort_order' => $index + 1,
            ]);
        }
    }
}
