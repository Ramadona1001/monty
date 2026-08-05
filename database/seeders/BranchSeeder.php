<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            [
                'icon' => 'fa-solid fa-headset',
                'name' => [
                    'en' => 'Customer Service',
                    'ar' => 'خدمة العملاء',
                ],
                'phone' => '0564175052',
                'address' => [
                    'en' => '',
                    'ar' => '',
                ],
                'sort_order' => 1,
            ],
            [
                'icon' => 'fa-solid fa-code-branch',
                'name' => [
                    'en' => 'Dammam Branch',
                    'ar' => 'فرع الدمام',
                ],
                'phone' => '0138300600 - 0138300655',
                'address' => [
                    'en' => 'Next to Al-Dawaa Pharmacy - King Abdul Aziz Street - Dammam',
                    'ar' => 'بجوار صيدليه الدواء - شارع الملك عبد العزيز - الدمام',
                ],
                'sort_order' => 2,
            ],
            [
                'icon' => 'fa-solid fa-code-branch',
                'name' => [
                    'en' => 'Al-Ahsa Branch',
                    'ar' => 'فرع الاحساء',
                ],
                'phone' => '0135846015 – 0135846016',
                'address' => [
                    'en' => 'Al-Ahsa Branch - Al-Jafer Road',
                    'ar' => 'فرع الاحساء - طريق الجفر',
                ],
                'sort_order' => 3,
            ],
        ];

        foreach ($branches as $branch) {
            Branch::query()->create(array_merge($branch, ['is_active' => true]));
        }
    }
}
