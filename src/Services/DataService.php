<?php

namespace Adgyn\SimpleAnalytics\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Adgyn\SimpleAnalytics\Models\Event;

class DataService
{
    /**
     * Start date to filter
     *
     * @var Carbon
     */
    private Carbon $start;

    /**
     * Finish date to filter
     *
     * @var Carbon
     */
    private Carbon $finish;

    /**
     * Analytics detailed
     *
     * @var boolean
     */
    private bool $detailed = false;

    /**
     * List of route
     *
     * @var string
     */
    private array $routes;
    
    /**
     * List of countries code
     *
     * @var string
     */
    private array $countries;

    /**
     * List of references
     *
     * @var string
     */
    private array $references;

    /**
     * Date filter
     *
     * @param null|string $start => Data start to filter (Format: Y-m-d H:i:s)
     * 
     * @return self
     */
    public function start(string $start): self
    {
        $this->start = Carbon::parse($start);
        return $this;
    }

    /**
     * Date filter
     *
     * @param null|string $finish => Data finish to filter (Format: Y-m-d H:i:s)
     * 
     * @return self
     */
    public function finish(string $finish): self
    {
        $this->finish = Carbon::parse($finish);
        return $this;
    }

    /**
     * Return analytics detailed
     *
     * @return self
     */
    public function detailed(): self
    {
        $this->detailed = true;
        return $this;
    }

    /**
     * Routes to filter
     *
     * @param array $route
     * @return self
     */
    public function routes(array $routes): self
    {
        $this->routes = $routes;
        return $this;
    }

    /**
     * Countries code to filter
     *
     * @param array $countries
     * @return self
     */
    public function countries(array $countries): self
    {
        $this->countries = $countries;
        return $this;
    }

    /**
     * References to filter
     *
     * @param array $reference
     * @return self
     */
    public function references(array $references): self
    {
        $this->references = $references;
        return $this;
    }

    public function get(): JsonResponse
    {
        $eventInstance = Event::when(!empty($this->start), function($query) {
            $query->where('created_at', '>=', $this->start);
        })->when(!empty($this->finish), function($query) {
            $query->where('created_at', '>', $this->finish);
        })->when(!empty($this->routes), function($query) {
            $query->whereIn('route', $this->routes);
        })->when(!empty($this->countries), function($query) {
            $query->whereIn('country', $this->countries);
        })->when(!empty($this->references), function($query) {
            $query->whereIn('reference', $this->references);
        });

        if(!$this->detailed) {
            return response()->json([
                'unique_visitors' => $eventInstance->clone()->groupBy('user_hash')->count('id'),
            ], 200);
        }
    }
}