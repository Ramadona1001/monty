<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopRequestRequest;
use App\Models\ShopRequest;
use Illuminate\Http\JsonResponse;

class ShopRequestController extends Controller
{
    public function store(StoreShopRequestRequest $request): JsonResponse
    {
        ShopRequest::query()->create($request->validated());

        return response()->json([
            'message' => __('site.shop.success'),
        ]);
    }
}
