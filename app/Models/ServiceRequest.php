<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequest extends Model
{
    use SoftDeletes;

    public const TYPE_INDIVIDUAL = 'individual';

    public const TYPE_PROJECT = 'project';

    /** @var list<string> */
    protected $fillable = [
        'branch_id',
        'service_request_type_id',
        'customer_type',
        'product_id',
        'is_all_products',
        'customer_name',
        'phone',
        'notes',
        'is_read',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
            'is_all_products' => 'boolean',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function serviceRequestType(): BelongsTo
    {
        return $this->belongsTo(ServiceRequestType::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productLabel(?string $locale = null): string
    {
        $locale ??= app()->getLocale();

        if ($this->is_all_products) {
            return __('site.service_request.all_products', [], $locale);
        }

        return $this->product?->getTranslation('title', $locale, false) ?? '—';
    }

    public function customerTypeLabel(?string $locale = null): string
    {
        $locale ??= app()->getLocale();

        return match ($this->customer_type) {
            self::TYPE_PROJECT => __('site.service_request.customer_type_project', [], $locale),
            default => __('site.service_request.customer_type_individual', [], $locale),
        };
    }
}
