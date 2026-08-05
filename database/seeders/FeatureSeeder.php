<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            [
                'icon' => 'fa-solid fa-user-tie',
                'title' => [
                    'en' => 'Design accuracy',
                    'ar' => 'دقة التصميم',
                ],
                'description' => [
                    'en' => 'The accuracy of the design is the most important thing that distinguishes us because we care about every detail of your kitchen, from the first choice of the appropriate type of wood to its design by specialized hands and international designs.',
                    'ar' => 'دقة التصميم هي أهم ما يميزنا لأننا نهتم بكل تفصيلة تخص المطبخ الخاص بك من أول إختيار نوع الخشب المناسب حتى تصميمه بأيادي متخصصين وبتصاميم عالمية',
                ],
                'sort_order' => 1,
            ],
            [
                'icon' => 'fa-solid fa-umbrella',
                'title' => [
                    'en' => 'Execution quality',
                    'ar' => 'جودة التنفيذ',
                ],
                'description' => [
                    'en' => 'We guarantee high quality in the implementation of our products because we use the latest equipment with professional hands.',
                    'ar' => 'نضمن لك الحصول على جودة عالية في تنفيذ منتجاتنا لأننا نستخدم أحدث الأجهزة بسواعد محترفة',
                ],
                'sort_order' => 2,
            ],
            [
                'icon' => 'fa-solid fa-pen-ruler',
                'title' => [
                    'en' => 'Speed and accuracy of delivery',
                    'ar' => 'سرعة ودقة التسليم',
                ],
                'description' => [
                    'en' => 'Not only about quality and accuracy but care about fast and accurate delivery while ensuring the quality of the products.',
                    'ar' => 'ليس فقط الجودة والدقة لكننا نهتم بسرعة ودقة التسليم مع ضمان جودة المنتجات',
                ],
                'sort_order' => 3,
            ],
        ];

        foreach ($features as $feature) {
            Feature::query()->create(array_merge($feature, ['is_active' => true]));
        }
    }
}
