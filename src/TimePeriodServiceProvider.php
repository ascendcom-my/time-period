<?php

namespace Bigmom\TimePeriod;

use Illuminate\Support\ServiceProvider;
use Bigmom\TimePeriod\Contracts\NamedTimePeriodResolver;
use Bigmom\TimePeriod\Services\CacheOrDatabaseNamedTimePeriodResolver;
use Bigmom\TimePeriod\Services\TimePeriodService;

class TimePeriodServiceProvider extends ServiceProvider
{
    public static bool $loadMigrations = true;

    public function register()
    {
        $this->app->singleton(NamedTimePeriodResolver::class, CacheOrDatabaseNamedTimePeriodResolver::class);
        $this->app->bind('time-period', function () {
            return new TimePeriodService;
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (static::$loadMigrations) {
                $this->loadMigrationsFrom(__DIR__.'/migrations');
            }
        }
    }

    public static function ignoreMigrations(): void
    {
        static::$loadMigrations = false;
    }
}
