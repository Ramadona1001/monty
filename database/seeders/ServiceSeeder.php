<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceFeature;
use App\Models\ServiceImage;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $kitchens = Service::query()->create([
            'slug' => 'kitchens',
            'number' => '01',
            'title' => [
                'en' => 'Design and implementation of kitchens',
                'ar' => 'تصميم وتنفيذ المطابخ',
            ],
            'excerpt' => [
                'en' => 'We provide you with the design and implementation of different types of wooden kitchens for all spaces, with different shapes and additions. Other types of wood are used',
                'ar' => 'نوفر لك تصميم وتنفيذ أنواع مختلفة من المطابخ الخشبية لكل المساحات وبإختلاف الأشكال والإضافات ويتم استخدام أنواع مختلفة من الخشب',
            ],
            'body' => [
                'en' => 'We provide you with the design and implementation of different types of wooden kitchens for all spaces, with different shapes and additions. Other types of wood are used, such as:',
                'ar' => 'نوفر لك تصميم وتنفيذ أنواع مختلفة من المطابخ الخشبية لكل المساحات وبإختلاف الأشكال والإضافات ويتم استخدام أنواع مختلفة من الخشب مثل:',
            ],
            'featured_image' => 'assets/img/services/kitchens/kitchen-1.webp',
            'sort_order' => 1,
            'is_featured' => true,
            'is_active' => true,
        ]);

        foreach ([
            'assets/img/services/kitchens/kitchen-1.webp',
            'assets/img/services/kitchens/kitchen-2.webp',
            'assets/img/services/kitchens/kitchen-3.webp',
        ] as $index => $image) {
            ServiceImage::query()->create([
                'service_id' => $kitchens->id,
                'image_path' => $image,
                'sort_order' => $index + 1,
            ]);
        }

        $woodTypes = [
            ['en' => 'red beech', 'ar' => 'خشب الزان الأحمر'],
            ['en' => 'musky wood', 'ar' => 'الخشب الموسكي'],
            ['en' => 'oak wood', 'ar' => 'خشب الآرو'],
            ['en' => 'Duco stained wood', 'ar' => 'خشب بطلاء دوكو'],
            ['en' => 'MDF wood', 'ar' => 'خشب MDF'],
            ['en' => 'Counter wood', 'ar' => 'خشب الكونتر'],
        ];

        foreach ($woodTypes as $index => $type) {
            ServiceFeature::query()->create([
                'service_id' => $kitchens->id,
                'name' => $type,
                'sort_order' => $index + 1,
            ]);
        }

        $cupboards = Service::query()->create([
            'slug' => 'cupboards',
            'number' => '02',
            'title' => [
                'en' => 'Kitchen cupboards',
                'ar' => 'خزائن المطابخ',
            ],
            'excerpt' => [
                'en' => 'Design and implementation of kitchen cabinets of all sizes and designs and using different types of wood against ambient changes',
                'ar' => 'تصميم وتنفيذ خزائن المطابخ بجميع الأحجام والتصاميم وبإستخدام أنواع مختلفة من الخشب المضاد للتغيرات المحيطة',
            ],
            'body' => [
                'en' => 'Design and implementation of kitchen cabinets of all sizes and designs, using different types of wood against environmental changes. One of the most critical features of Al-Saeed cabinets is that they are of high quality and one of the best types of wood treated against cracking, damage, and other problems. We can design and implement all shapes and sizes of kitchen cabinets to suit your needs.',
                'ar' => 'تصميم وتنفيذ خزائن المطابخ بجميع الأحجام والتصاميم وبإستخدام أنواع مختلفة من الخشب المضاد للتغيرات المحيطة. ومن أهم ما يميز خزائن السعيد أنها ذات جودة عالية ومن أفضل أنواع الخشب المعالج ضد مشاكل التشقق والتلف وغيرها. وبإمكاننا تصميم وتنفيذ كل الأشكال والأحجام من خزائن المطبخ لتناسب إحتياجاتك',
            ],
            'featured_image' => 'assets/img/services/cupboards/cupboards-4.webp',
            'sort_order' => 2,
            'is_featured' => true,
            'is_active' => true,
        ]);

        foreach ([
            'assets/img/services/cupboards/cupboards-1.webp',
            'assets/img/services/cupboards/cupboards-2.webp',
            'assets/img/services/cupboards/cupboards-3.webp',
            'assets/img/services/cupboards/cupboards-4.webp',
        ] as $index => $image) {
            ServiceImage::query()->create([
                'service_id' => $cupboards->id,
                'image_path' => $image,
                'sort_order' => $index + 1,
            ]);
        }

        $laundromats = Service::query()->create([
            'slug' => 'laundromats',
            'number' => '03',
            'title' => [
                'en' => 'Laundromats',
                'ar' => 'مغاسل',
            ],
            'excerpt' => [
                'en' => 'Wooden laundries are a unique piece of art, and at Al Saeed Kitchen Company, we provide you with high-quality wooden laundries that are harmless over time with unique designs.',
                'ar' => 'المغاسل الخشبية تمثل قطعة فنية فريدة من نوعها وفي شركة مونتي للمطابخ والخزائن نوفر لك مغاسل خشبية ذات جودة عالية غير قابلة للضرر مع مرور الوقت وبتصميمات فريدة',
            ],
            'body' => [
                'en' => 'Wooden sinks represent a unique piece of art. At Al-Saeed Kitchen Company, we provide you with high-quality wooden sinks that are not subject to damage over time and with unique designs. The most critical thing distinguishing Al-Saeed washbasins is that they are not damaged by water over time because they are coated with waterproof materials, thus maintaining their quality for the longest possible period.',
                'ar' => 'المغاسل الخشبية تمثل قطعة فنية فريدة من نوعها وفي شركة مونتي للمطابخ والخزائن نوفر لك مغاسل خشبية ذات جودة عالية غير قابلة للضرر مع مرور الوقت وبتصميمات فريدة. وأهم ما يميز مغاسل السعيد أنها لا تتلف بسبب الماء مع مرور الوقت لأنها تطلى بمواد مضادة للماء وبالتالي المحافظة على جودتها لأطول فترة ممكنة',
            ],
            'featured_image' => 'assets/img/services/laundromats/Laundromats-2.webp',
            'sort_order' => 3,
            'is_featured' => true,
            'is_active' => true,
        ]);

        foreach ([
            'assets/img/services/laundromats/Laundromats-1.webp',
            'assets/img/services/laundromats/Laundromats-2.webp',
            'assets/img/services/laundromats/Laundromats-3.webp',
        ] as $index => $image) {
            ServiceImage::query()->create([
                'service_id' => $laundromats->id,
                'image_path' => $image,
                'sort_order' => $index + 1,
            ]);
        }
    }
}
