<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    public function run(): void
    {
        $statistics = [
            [
                'icon' => 'fa-solid fa-users',
                'value' => '+1000',
                'label' => ['en' => 'customers', 'ar' => 'عميل'],
                'sort_order' => 1,
            ],
            [
                'icon' => 'fa-solid fa-kitchen-set',
                'value' => '+1000',
                'label' => ['en' => 'projects', 'ar' => 'مشروع'],
                'sort_order' => 2,
            ],
            [
                'icon' => 'fa-solid fa-clock-rotate-left',
                'value' => '+50',
                'label' => ['en' => 'experience', 'ar' => 'خبرة'],
                'sort_order' => 3,
            ],
            [
                'icon' => 'fa-solid fa-user-tie',
                'value' => '+500',
                'label' => ['en' => 'professional employees', 'ar' => 'موظف محترف'],
                'sort_order' => 4,
            ],
        ];

        foreach ($statistics as $statistic) {
            Statistic::query()->create(array_merge($statistic, ['is_active' => true]));
        }
    }
}
