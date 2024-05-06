<?php

namespace Adgyn\SimpleAnalytics;

use Illuminate\Support\ServiceProvider;

class SimpleAnalyticsProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/analytics.php' => config_path('analytics.php'),
        ], 'simple-analytics');

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'simple-analytics');
    }
}