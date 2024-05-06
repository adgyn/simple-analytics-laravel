<?php

namespace Adgyn\SimpleAnalytics;

use Generator;
use Illuminate\Support\Str;
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

        $migrations = [];
        foreach (glob(__DIR__.'/../database/migrations/*.php') as $migration) {
            $migrations[__DIR__.'/../database/migrations/'.$migration] = database_path('migrations/').now()->format('Y_m_d_His_').$migration;
        }

        if(!empty($migrations)) {
            $this->publishesMigrations($migrations, 'simple-analytics');
        }
    }
}