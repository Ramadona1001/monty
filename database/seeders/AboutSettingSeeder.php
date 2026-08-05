<?php

namespace Database\Seeders;

use App\Models\AboutSetting;
use Illuminate\Database\Seeder;

class AboutSettingSeeder extends Seeder
{
    public function run(): void
    {
        AboutSetting::query()->create([
            'home_subheading' => [
                'en' => 'Know Our Story',
                'ar' => 'تعرّف على قصتنا',
            ],
            'home_heading' => [
                'en' => 'Al-Saeed Kitchen Company',
                'ar' => 'شركة مونتي للمطابخ والخزائن',
            ],
            'home_body' => [
                'en' => 'More than 50 years ago, we started designing and making wooden kitchens with experienced and highly experienced bases. To produce high-quality kitchens using the best types of wood-treated and anti-damage. We promise to continue to provide the best products to ensure you have high quality at competitive prices, based on extensive experience in the industry and by enabling innovative engineering minds that provide the best services to you.',
                'ar' => 'منذ أكثر من خمسين عامٍ بدأنا في تصميم وصناعة المطابخ الخشبية بسواعد متمرسة ذات خبرة عالية لإنتاج مطابخ عالية الجودة بإستخدام أفضل أنواع الأخشاب المعالجة والمضادة للأضرار لنضمن لك الحصول على جودة عالية بأسعار تنافسية مرتكزين على خبرة واسعة في مجال الصناعة وبتمكين العقول الهندسية المبتكرة التي تعمل على توفير أفضل الخدمات لكم نعدكم بالإستمرار في تقديم أفضل المنتجات',
            ],
            'intro_title' => [
                'en' => '(Al-Saeed Company) If you are looking for the best',
                'ar' => '(شركة السعيد) إذا كنت تبحث عن الأفضل',
            ],
            'intro_subtitle' => [
                'en' => 'With more than 50 years of experience',
                'ar' => 'بخبرة أكثر من 50 عام',
            ],
            'intro_body' => [
                'en' => 'Depending on rich experience, professional forearms, and innovative minds, Al-Saeed Kitchen Company launched more than 50 years ago to become one of the leading companies in designing and implementing wooden kitchens of various types, using different kinds of wood of high quality and anti-external factors. We guarantee you that our products are not easily damaged. And using high-quality paints that are not susceptible to damage or falling off the surface of the wood',
                'ar' => 'إعتمادًا على خبرة مثقلة وسواعد مهنية محترفة وعقول مبتكرة انطلقت شركة مونتي للمطابخ والخزائن منذ أكثر من 50 عام لتصبح من الشركات الرائدة في تصميم وتنفيذ المطابخ الخشبية بأنواعها المختلفة وبإستخدام أنواع مختلفة من الأخشاب ذات الجودة العالية والمضادة للعوامل الخارجية فنحن نضمن لك أن منتجاتنا غير قالبة للتلف بسهولة وبأستخدام دهانات ذات جودة عالية غير قالبة للتلف أو السقوط من على سطح الخشب',
            ],
            'intro_image' => 'assets/img/about/about_bg-1.jpg',
            'vision_title' => [
                'en' => 'Our vision',
                'ar' => 'رؤيتنا',
            ],
            'vision_body' => [
                'en' => 'We aspire to be one of the pioneers in the field of designing and manufacturing wooden kitchens, and this has already been achieved, but we are continuing our success.',
                'ar' => 'نطمح لأن نكون من رواد مجال تصميم وصناعة المطابخ الخشبية وهذا بالفعل ما تم تحقيقه لكننا مستمرون في نجاحنا',
            ],
            'mission_title' => [
                'en' => 'Our message',
                'ar' => 'رسالتنا',
            ],
            'mission_body' => [
                'en' => 'Providing the best products to our customers while ensuring that they comply with international quality standards',
                'ar' => 'تقديم أفضل المنتجات لعملائنا مع ضمان تطابقها مع معايير الجودة العالمية',
            ],
            'services_subheading' => [
                'en' => 'Our services',
                'ar' => 'نقدم لك',
            ],
            'services_heading' => [
                'en' => 'What we offer you',
                'ar' => 'خدماتنا',
            ],
            'services_intro' => [
                'en' => 'We offer you several services, including.',
                'ar' => 'نقدم لكم عدة خدمات منها',
            ],
            'progress_subheading' => [
                'en' => 'How we work',
                'ar' => 'كيف نعمل',
            ],
            'progress_heading' => [
                'en' => 'Phases of our work',
                'ar' => 'مراحل عملنا',
            ],
        ]);
    }
}
