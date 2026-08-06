<?php

namespace App\Models;

use App\Models\Concerns\ClearsFrontendCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ServiceRequestType extends Model
{
    use ClearsFrontendCache;
    use HasTranslations;
    use SoftDeletes;

    /** @var list<string> */
    public array $translatable = ['name', 'description'];

    /** @var list<string> */
    protected $fillable = [
        'slug',
        'icon',
        'name',
        'description',
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

    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }
}
