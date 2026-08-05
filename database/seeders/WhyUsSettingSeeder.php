<?php

namespace Database\Seeders;

use App\Models\WhyUsSetting;
use Illuminate\Database\Seeder;

class WhyUsSettingSeeder extends Seeder
{
    public function run(): void
    {
        WhyUsSetting::query()->create([
            'title' => [
                'en' => 'Why Choose Monty for kitchens?',
                'ar' => 'لماذا تختار مونتي للمطابخ؟',
            ],
            'bullets' => [
                'en' => [
                    'Your first choice for the best products.',
                    'We provide Saudi-made products with high-quality German technology that meets international standards.',
                    'We guarantee that you will get high-quality products at competitive prices.',
                    'We provide innovative designs to suit all tastes.',
                    'We are committed to accuracy in delivery.',
                ],
                'ar' => [
                    'إختيارك الأول للحصول على أفضل المنتجات',
                    'نوفر منتجات بصناعة سعودية بتقنية ألمانية عالية الجودة تناسب المعايير العالمية',
                    'نضمن لك الحصول على جودة عالية بأسعار تنافسية',
                    'نوفر تصميمات مبتكرة تناسب كل الأذواق',
                    'نلتزم بالدقة في التسليم',
                ],
            ],
            'video_path' => 'assets/monty-vid.mp4',
            'poster_path' => 'assets/img/vid-poster.png',
        ]);
    }
}
