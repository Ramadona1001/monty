<?php

namespace App\Models;

use App\Models\Concerns\ClearsFrontendCache;
use Illuminate\Database\Eloquent\Model;
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
}
