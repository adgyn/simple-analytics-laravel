<?php

namespace Adgyn\SimpleAnalytics\Services;

use Adgyn\SimpleAnalytics\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $hash = $request->cookie('user_hash');
        $cookie = null;
        if(empty($hash)) {
            $hash = Str::uuid()->toString();
            $cookie = cookie('user_hash', $hash, config('simple_analytics.session_timeout'))->withHttpOnly();
        }

        $request->merge(['reference' => $hash]);

        Event::create($request->only('event_name', 'event_label', 'route', 'reference'));

        if(!empty($cookie)) {
            return response()->json(['message' => 'Event registred.'], 201)->cookie($cookie);
        }

        return response()->json(['message' => 'Event registred.'], 201);
    }
}