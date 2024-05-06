<?php

namespace Adgyn\SimpleAnalytics;

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
            $migrations[$migration] = database_path('migrations/').now()->format('Y_m_d_His_').Str::after($migration, 'migration_');
            sleep(1);
        }

        if(!empty($migrations)) {
            $this->publishesMigrations($migrations, 'simple-analytics');
        }

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}