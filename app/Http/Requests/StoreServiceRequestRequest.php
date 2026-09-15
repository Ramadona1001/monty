<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\ServiceRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        $measurementProductIds = Product::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(10)
            ->pluck('id')
            ->all();

        return [
            'branch_id' => ['required', 'integer', Rule::exists('branches', 'id')->where('is_active', true)],
            'service_request_type_id' => ['required', 'integer', Rule::exists('service_request_types', 'id')->where('is_active', true)],
            'customer_type' => ['required', 'string', Rule::in([ServiceRequest::TYPE_INDIVIDUAL, ServiceRequest::TYPE_PROJECT])],
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'product_ids' => ['required', 'array', 'min:1'],
            'product_ids.*' => ['integer', Rule::in($measurementProductIds)],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
