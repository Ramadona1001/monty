<?php

namespace App\Models;

use App\Models\Concerns\ClearsFrontendCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use ClearsFrontendCache;
    use HasTranslations;
    use SoftDeletes;

    /** @var list<string> */
    public array $translatable = ['title', 'excerpt'];

    /** @var list<string> */
    protected $fillable = [
        'slug',
        'product_category_id',
        'title',
        'excerpt',
        'image',
        'sort_order',
        'is_active',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    /** @return list<string> */
    public function galleryImagePaths(): array
    {
        $paths = [];

        if ($this->image) {
            $paths[] = $this->image;
        }

        foreach ($this->images as $image) {
            if ($image->image_path && ! in_array($image->image_path, $paths, true)) {
                $paths[] = $image->image_path;
            }
        }

        return $paths;
    }
}
