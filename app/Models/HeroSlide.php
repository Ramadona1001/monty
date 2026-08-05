<?php

namespace App\Models;

use App\Models\Concerns\ClearsFrontendCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class HeroSlide extends Model
{
    use ClearsFrontendCache;
    use HasTranslations;
    use SoftDeletes;

    /** @var list<string> */
    public array $translatable = [
        'subtitle',
        'title',
        'tagline',
        'button_text',
    ];

    /** @var list<string> */
    protected $fillable = [
        'subtitle',
        'title',
        'tagline',
        'button_text',
        'button_url',
        'background_image',
        'overlay_color',
        'overlay_opacity',
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
