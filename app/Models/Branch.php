<?php

namespace App\Models;

use App\Models\Concerns\ClearsFrontendCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Branch extends Model
{
    use ClearsFrontendCache;
    use HasTranslations;
    use SoftDeletes;

    /** @var list<string> */
    public array $translatable = ['name', 'address'];

    /** @var list<string> */
    protected $fillable = [
        'icon',
        'name',
        'phone',
        'email',
        'whatsapp',
        'address',
        'sort_order',
        'is_active',
    ];

    public function hasContactInfo(?string $locale = null): bool
    {
        $locale ??= app()->getLocale();

        return filled($this->phone)
            || filled($this->email)
            || filled($this->whatsapp)
            || filled($this->getTranslation('address', $locale, false));
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
