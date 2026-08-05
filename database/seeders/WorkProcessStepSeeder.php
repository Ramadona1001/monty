<?php

namespace Database\Seeders;

use App\Models\WorkProcessStep;
use Illuminate\Database\Seeder;

class WorkProcessStepSeeder extends Seeder
{
    public function run(): void
    {
        $steps = [
            [
                'number' => '01',
                'title' => [
                    'en' => 'Book an appointment from our site',
                    'ar' => 'حجز موعد من موقعنا',
                ],
                'description' => [
                    'en' => 'You can now easily book an appointment by registering your data',
                    'ar' => 'بعد قيامك بحجز موعد من موقعنا يقوم المتخصصين بزيارتك لتحديد المقاسات المناسبة للمساحة المراد وضع المطبخ او الخزانة او المغسلة',
                ],
                'layout' => 'image-left',
            ],
            [
                'number' => '02',
                'title' => [
                    'en' => 'Free preview to select sizes and kitchen space',
                    'ar' => 'معاينة مجانية لتحديد مقاسات ومساحة المطبخ',
                ],
                'description' => [
                    'en' => 'After you book an appointment from our site, specialists visit you to determine the appropriate sizes for the space to be placed in the kitchen, closet or laundry',
                    'ar' => 'بعد قيامك بحجز موعد من موقعنا يقوم المتخصصين بزيارتك لتحديد المقاسات المناسبة للمساحة المراد وضع المطبخ او الخزانة او المغسلة',
                ],
                'layout' => 'image-right',
            ],
            [
                'number' => '03',
                'title' => [
                    'en' => 'Kitchen design, cabinet, or laundry',
                    'ar' => 'تصميم المطبخ أو الخزانة او المغسلة',
                ],
                'description' => [
                    'en' => 'The design is done by specialized engineers to carry out the design you want easily, literally, and accurately',
                    'ar' => 'يتم التصميم من خلال مهندسين متخصصين لتنفيذ التصميم الذي تريده بسهولة وبحرفية ودقة',
                ],
                'layout' => 'image-left',
            ],
            [
                'number' => '04',
                'title' => [
                    'en' => 'Design Implementation',
                    'ar' => 'تنفيذ التصميم',
                ],
                'description' => [
                    'en' => 'We execute the design with precision from our workers\' craft to deliver the best products to our customers.',
                    'ar' => 'نقوم بتنفيذ التصميم بدقة تنم عن حرفة عمالنا لتقديم أفضل المنتجات لعملائنا',
                ],
                'layout' => 'image-right',
            ],
            [
                'number' => '05',
                'title' => [
                    'en' => 'Installation work',
                    'ar' => 'أعمال التركيب',
                ],
                'description' => [
                    'en' => 'Specialized workers do the installation with high efficiency and skill.',
                    'ar' => 'يتم التركيب من خلال عمال متخصصين ذو كفاءة ومهارة عالية',
                ],
                'layout' => 'image-left',
            ],
        ];

        foreach ($steps as $index => $step) {
            WorkProcessStep::query()->create(array_merge($step, [
                'image_path' => 'assets/img/idea.png',
                'sort_order' => $index + 1,
                'is_active' => true,
            ]));
        }
    }
}
