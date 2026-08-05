<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\UiTranslationService;
use Spatie\Translatable\HasTranslations;

class UiTranslation extends Model
{
    use HasTranslations;

    /** @var list<string> */
    public array $translatable = ['value'];

    /** @var list<string> */
    protected $fillable = [
        'group',
        'key',
        'value',
    ];

    protected static function booted(): void
    {
        $clear = fn () => app(UiTranslationService::class)->clearCache();

        static::saved($clear);
        static::deleted($clear);
    }
}
