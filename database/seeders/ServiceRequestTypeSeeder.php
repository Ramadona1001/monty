<?php

namespace Database\Seeders;

use App\Models\ServiceRequestType;
use Illuminate\Database\Seeder;

class ServiceRequestTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'slug' => 'measurement',
                'icon' => 'fa-solid fa-ruler-combined',
                'name' => [
                    'en' => 'Measurement request',
                    'ar' => 'رفع مقاس',
                ],
                'description' => [
                    'en' => 'We will visit you to take the required measurements.',
                    'ar' => 'سنقوم بزيارتكم لأخذ المقاسات المطلوبة.',
                ],
                'sort_order' => 1,
            ],
            [
                'slug' => 'maintenance',
                'icon' => 'fa-solid fa-screwdriver-wrench',
                'name' => [
                    'en' => 'Maintenance request',
                    'ar' => 'طلب صيانة',
                ],
                'description' => [
                    'en' => 'Request maintenance or repair for your kitchen.',
                    'ar' => 'طلب صيانة أو إصلاح لمطبخك.',
                ],
                'sort_order' => 2,
            ],
        ];

        foreach ($types as $type) {
            ServiceRequestType::query()->create(array_merge($type, ['is_active' => true]));
        }
    }
}
