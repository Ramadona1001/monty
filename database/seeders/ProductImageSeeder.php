<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $galleryPool = [
            'assets/img/services/kitchens/kitchen-1.webp',
            'assets/img/services/kitchens/kitchen-2.webp',
            'assets/img/services/kitchens/kitchen-3.webp',
            'assets/img/services/cupboards/cupboards-1.webp',
            'assets/img/services/cupboards/cupboards-2.webp',
            'assets/img/services/cupboards/cupboards-3.webp',
            'assets/img/services/cupboards/cupboards-4.webp',
            'assets/img/services/laundromats/Laundromats-1.webp',
            'assets/img/services/laundromats/Laundromats-2.webp',
            'assets/img/services/laundromats/Laundromats-3.webp',
        ];

        Product::query()
            ->orderBy('sort_order')
            ->get()
            ->each(function (Product $product, int $index) use ($galleryPool): void {
                $product->images()->delete();

                $offset = $index % count($galleryPool);
                $extraImages = [
                    $galleryPool[$offset],
                    $galleryPool[($offset + 2) % count($galleryPool)],
                    $galleryPool[($offset + 4) % count($galleryPool)],
                ];

                foreach ($extraImages as $sortOrder => $imagePath) {
                    if ($imagePath === $product->image) {
                        continue;
                    }

                    ProductImage::query()->create([
                        'product_id' => $product->id,
                        'image_path' => $imagePath,
                        'sort_order' => $sortOrder + 1,
                    ]);
                }
            });
    }
}
