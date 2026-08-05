<?php

namespace App\Models;

use App\Models\Concerns\ClearsFrontendCache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutSetting extends Model
{
    use ClearsFrontendCache;
    use HasTranslations;

    /** @var list<string> */
    public array $translatable = [
        'intro_title',
        'intro_subtitle',
        'intro_body',
        'vision_title',
        'vision_body',
        'mission_title',
        'mission_body',
        'home_subheading',
        'home_heading',
        'home_body',
        'services_subheading',
        'services_heading',
        'services_intro',
        'progress_subheading',
        'progress_heading',
    ];

    /** @var list<string> */
    protected $fillable = [
        'intro_title',
        'intro_subtitle',
        'intro_body',
        'intro_image',
        'vision_title',
        'vision_body',
        'mission_title',
        'mission_body',
        'home_subheading',
        'home_heading',
        'home_body',
        'services_subheading',
        'services_heading',
        'services_intro',
        'progress_subheading',
        'progress_heading',
    ];
}
