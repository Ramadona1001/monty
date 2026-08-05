<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'subtitle' => [
                    'en' => 'Monty Company for Kitchens & Cabinets',
                    'ar' => 'شركة مونتي للمطابخ والخزائن',
                ],
                'title' => [
                    'en' => 'Because you deserve the best and the highest quality',
                    'ar' => 'لأنك تستحق الأفضل والأعلى جودة',
                ],
                'tagline' => [
                    'en' => 'Choose your kitchen now and guarantee the quality',
                    'ar' => 'إختر مطبخك الأن وأضمن الجودة',
                ],
                'button_text' => [
                    'en' => 'Ask for a preview now.',
                    'ar' => 'أطلب المعاينة الآن',
                ],
                'button_url' => '/contact#form',
                'background_image' => 'assets/img/slider/slider.webp',
                'overlay_color' => '#000000',
                'overlay_opacity' => 0,
                'sort_order' => 1,
            ],
            [
                'subtitle' => [
                    'en' => 'Monty Company for Kitchens & Cabinets',
                    'ar' => 'شركة مونتي للمطابخ والخزائن',
                ],
                'title' => [
                    'en' => 'Because you deserve the best and the highest quality',
                    'ar' => 'لأنك تستحق الأفضل والأعلى جودة',
                ],
                'tagline' => [
                    'en' => 'Choose your kitchen now and guarantee the quality',
                    'ar' => 'إختر مطبخك الأن وأضمن الجودة',
                ],
                'button_text' => [
                    'en' => 'Ask for a preview now.',
                    'ar' => 'أطلب المعاينة الآن',
                ],
                'button_url' => '/contact#form',
                'background_image' => 'assets/img/slider/slider1.webp',
                'overlay_color' => '#000000',
                'overlay_opacity' => 0,
                'sort_order' => 2,
            ],
            [
                'subtitle' => [
                    'en' => 'Monty Company for Kitchens & Cabinets',
                    'ar' => 'شركة مونتي للمطابخ والخزائن',
                ],
                'title' => [
                    'en' => 'Because you deserve the best and the highest quality',
                    'ar' => 'لأنك تستحق الأفضل والأعلى جودة',
                ],
                'tagline' => [
                    'en' => 'Choose your kitchen now and guarantee the quality',
                    'ar' => 'إختر مطبخك الأن وأضمن الجودة',
                ],
                'button_text' => [
                    'en' => 'Ask for a preview now.',
                    'ar' => 'أطلب المعاينة الآن',
                ],
                'button_url' => '/contact#form',
                'background_image' => 'assets/img/slider/slider2.webp',
                'overlay_color' => '#000000',
                'overlay_opacity' => 0,
                'sort_order' => 3,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::query()->create(array_merge($slide, ['is_active' => true]));
        }
    }
}
