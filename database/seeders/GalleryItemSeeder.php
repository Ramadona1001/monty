<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GalleryItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => [
                    'en' => 'Modern kitchen design',
                    'ar' => 'تصميم مطبخ عصري',
                ],
                'media_type' => GalleryItem::TYPE_IMAGE,
                'media_path' => 'assets/img/services/kitchens/kitchen-1.webp',
                'media_url' => null,
                'sort_order' => 1,
            ],
            [
                'title' => [
                    'en' => 'Luxury cupboards',
                    'ar' => 'خزائن فاخرة',
                ],
                'media_type' => GalleryItem::TYPE_IMAGE,
                'media_path' => 'assets/img/services/cupboards/cupboards-1.webp',
                'media_url' => null,
                'sort_order' => 2,
            ],
            [
                'title' => [
                    'en' => 'Kitchen project showcase',
                    'ar' => 'عرض مشروع مطبخ',
                ],
                'media_type' => GalleryItem::TYPE_VIDEO,
                'media_path' => null,
                'media_url' => 'https://www.youtube.com/watch?v=LXb3EKWsInQ',
                'sort_order' => 3,
            ],
            [
                'title' => [
                    'en' => 'Interior walkthrough',
                    'ar' => 'جولة داخلية',
                ],
                'media_type' => GalleryItem::TYPE_VIDEO,
                'media_path' => null,
                'media_url' => 'https://vimeo.com/76979871',
                'sort_order' => 4,
            ],
            [
                'title' => [
                    'en' => 'Laundry room design',
                    'ar' => 'تصميم غرفة غسيل',
                ],
                'media_type' => GalleryItem::TYPE_IMAGE,
                'media_path' => 'assets/img/services/laundromats/Laundromats-1.webp',
                'media_url' => null,
                'sort_order' => 5,
            ],
            [
                'title' => [
                    'en' => 'Premium kitchen finish',
                    'ar' => 'تشطيب مطبخ مميز',
                ],
                'media_type' => GalleryItem::TYPE_IMAGE,
                'media_path' => 'assets/img/services/kitchens/kitchen-2.webp',
                'media_url' => null,
                'sort_order' => 6,
            ],
        ];

        foreach ($items as $item) {
            GalleryItem::query()->create(array_merge($item, ['is_active' => true]));
        }
    }
}
