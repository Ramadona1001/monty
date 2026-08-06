<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequest extends Model
{
    use SoftDeletes;

    /** @var list<string> */
    protected $fillable = [
        'branch_id',
        'service_request_type_id',
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
}
