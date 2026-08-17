<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'home',
                'title' => [
                    'en' => 'Home',
                    'ar' => 'الصفحة الرئيسية',
                ],
                'seo_title' => [
                    'en' => 'Monty Company for Kitchens & Cabinets',
                    'ar' => 'شركة مونتي للمطابخ والخزائن',
                ],
                'seo_description' => [
                    'en' => 'Monty Company for Kitchens & Cabinets - high quality wooden kitchens, cupboards and laundries.',
                    'ar' => 'شركة مونتي للمطابخ والخزائن - مطابخ وخزائن ومغاسل خشبية عالية الجودة.',
                ],
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'slug' => 'about',
                'title' => [
                    'en' => 'About us',
                    'ar' => 'عن الشركة',
                ],
                'banner_image' => 'assets/img/banner/banner.jpg',
                'seo_title' => [
                    'en' => 'About Monty Kitchens',
                    'ar' => 'عن شركة مونتي للمطابخ',
                ],
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'slug' => 'services',
                'title' => [
                    'en' => 'Services',
                    'ar' => 'خدماتنا',
                ],
                'banner_image' => 'assets/img/banner/banner.jpg',
                'seo_title' => [
                    'en' => 'Our Services',
                    'ar' => 'خدماتنا',
                ],
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'slug' => 'gallery',
                'title' => [
                    'en' => 'Gallery',
                    'ar' => 'المعرض',
                ],
                'banner_image' => 'assets/img/banner/banner.jpg',
                'seo_title' => [
                    'en' => 'Our Gallery',
                    'ar' => 'معرض أعمالنا',
                ],
                'seo_description' => [
                    'en' => 'Browse our latest kitchen, cupboard and laundry room projects.',
                    'ar' => 'تصفح أحدث مشاريع المطابخ والخزائن وغرف الغسيل.',
                ],
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'slug' => 'contact',
                'title' => [
                    'en' => 'Contact us',
                    'ar' => 'تواصل معنا',
                ],
                'banner_image' => 'assets/img/banner/banner.jpg',
                'seo_title' => [
                    'en' => 'Order our products easily',
                    'ar' => 'اطلب منتجاتنا بسهولة',
                ],
                'seo_description' => [
                    'en' => 'Get the best products with high quality and competitive prices easily',
                    'ar' => 'احصل على أفضل المنتجات بجودة عالية وبأسعار منافسة بسهولة',
                ],
                'status' => 'published',
                'published_at' => now(),
            ],
        ];

        foreach ($pages as $page) {
            Page::query()->updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
