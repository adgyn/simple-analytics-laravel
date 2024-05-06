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

        $request->merge(['user_hash' => $hash]);

        Event::create($request->only('event_name', 'event_label', 'route', 'reference', 'country', 'country_code', 'user_hash'));

        if(!empty($cookie)) {
            return response()->json(['message' => 'Event registred.'], 201)->cookie($cookie);
        }

        return response()->json(['message' => 'Event registred.'], 201);
    }

    /**
     * Return analytics data
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function data(Request $request): JsonResponse
    {
        $data = new DataService;

        if($request->has('start_at')) {
            $data->start($request->safe()->start_at);
        }

        if($request->has('finish_at')) {
            $data->finish($request->safe()->finish_at);
        }

        if($request->has('detailed')) {
            $data->detailed();
        }

        if($request->has('routes')) {
            $data->routes($request->safe()->routes);
        }

        if($request->has('countries')) {
            $data->countries($request->safe()->countries);
        }

        if($request->has('references')) {
            $data->references($request->safe()->references);
        }

        return $data->get();
    }

}