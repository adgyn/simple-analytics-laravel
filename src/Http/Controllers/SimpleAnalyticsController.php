<?php

namespace Adgyn\SimpleAnalytics\Http\Controllers;

use Adgyn\SimpleAnalytics\Http\Requests\StoreRequest;
use Adgyn\SimpleAnalytics\Models\Event;
use Adgyn\SimpleAnalytics\Services\SimpleAnalyticsService;
use Illuminate\Http\JsonResponse;

class SimpleAnalyticsController
{
    public function __construct(private Event $event, private SimpleAnalyticsService $service)
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
}