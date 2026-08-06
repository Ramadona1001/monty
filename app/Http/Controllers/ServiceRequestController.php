<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequestRequest;
use App\Models\ServiceRequest;
use Illuminate\Http\JsonResponse;

class ServiceRequestController extends Controller
{
    public function store(StoreServiceRequestRequest $request): JsonResponse
    {
        ServiceRequest::query()->create($request->validated());

        return response()->json([
            'message' => __('site.service_request.success'),
        ]);
    }
}
