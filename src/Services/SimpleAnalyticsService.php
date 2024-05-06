<?php

namespace Adgyn\SimpleAnalytics\Services;

use Adgyn\SimpleAnalytics\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class SimpleAnalyticsService
{
    /**
     * Store a new event
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $hash = Cache::get('user_hash');
        if(empty($hash)) {
            $hash = Str::uuid()->toString();
            Cookie::make('user_hash', $hash, config('simple_analytics.session_timeout'), null, null, true, true);
        }

        $request->merge(['reference' => $hash]);

        Event::create($request->only('event_name', 'event_label', 'route', 'reference'));

        return response()->json(['message' => 'Event registred.'], 201);
    }
}