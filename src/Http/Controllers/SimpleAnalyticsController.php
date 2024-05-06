<?php

namespace Adgyn\SimpleAnalytics\Http\Controllers;

use Adgyn\SimpleAnalytics\Http\Requests\StoreRequest;
use Adgyn\SimpleAnalytics\Http\Requests\DataRequest;
use Adgyn\SimpleAnalytics\Services\SimpleAnalyticsService;
use Illuminate\Http\JsonResponse;

class SimpleAnalyticsController
{
    public function __construct(private SimpleAnalyticsService $service)
    { }

    /**
     * Store a new event
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        return $this->service->store($request);
    }

    /**
     * Return analytics data
     *
     * @param DataRequest $request
     * @return JsonResponse
     */
    public function data(DataRequest $request): JsonResponse
    {
        return $this->service->data($request);
    }
}