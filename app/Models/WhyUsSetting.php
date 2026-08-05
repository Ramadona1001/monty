<?php

namespace App\Models;

use App\Models\Concerns\ClearsFrontendCache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WhyUsSetting extends Model
{
    use ClearsFrontendCache;
    use HasTranslations;

    /** @var list<string> */
    public array $translatable = ['title', 'bullets'];

    /** @var list<string> */
    protected $fillable = [
        'title',
        'bullets',
        'video_path',
        'poster_path',
    ];
}
