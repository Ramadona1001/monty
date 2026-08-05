<?php

namespace Database\Seeders;

use App\Models\UiTranslation;
use Illuminate\Database\Seeder;

class UiTranslationSeeder extends Seeder
{
    public function run(): void
    {
        /** @var array<string, array<string, array{en: string, ar: string}>> $groups */
        $groups = [
            'nav' => [
                'home' => ['en' => 'Home', 'ar' => 'الصفحة الرئيسية'],
                'services' => ['en' => 'Services', 'ar' => 'خدماتنا'],
                'about' => ['en' => 'About us', 'ar' => 'عن الشركة'],
                'contact' => ['en' => 'Contact us', 'ar' => 'تواصل معنا'],
                'quote' => ['en' => 'Get A Quote', 'ar' => 'طلب سعر'],
                'language' => ['en' => 'Ar', 'ar' => 'En'],
            ],
            'footer' => [
                'address_heading' => ['en' => 'Address', 'ar' => 'تواصلوا معنا'],
            ],
            'pages' => [
                'home' => ['en' => 'Home', 'ar' => 'الصفحة الرئيسية'],
            ],
            'buttons' => [
                'read_more' => ['en' => 'read more', 'ar' => 'أعرف المزيد'],
                'contact' => ['en' => 'Contact', 'ar' => 'تواصل معنا'],
            ],
            'contact' => [
                'name' => ['en' => 'Name', 'ar' => 'الآسم'],
                'email' => ['en' => 'E-mail', 'ar' => 'البريد الألكتروني'],
                'phone' => ['en' => 'Phone', 'ar' => 'الجوال'],
                'message' => ['en' => 'Message...', 'ar' => 'رسالتك...'],
                'send' => ['en' => 'Send', 'ar' => 'إرسال'],
                'success' => ['en' => 'Thank you! Your message has been sent successfully.', 'ar' => 'شكراً لك! تم إرسال رسالتك بنجاح.'],
            ],
        ];

        foreach ($groups as $group => $keys) {
            foreach ($keys as $key => $values) {
                UiTranslation::query()->updateOrCreate(
                    ['group' => $group, 'key' => $key],
                    ['value' => $values],
                );
            }
        }
    }
}
