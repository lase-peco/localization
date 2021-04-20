<?php

namespace LasePeco\Localization;

use Illuminate\Support\ServiceProvider;

class LocalizationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('localization.php'),
            ], 'config');
        }

        $this->registerCarbonMacros();
    }

    protected function registerCarbonMacros()
    {
        \Carbon\Carbon::macro('intlDateFormat', function () {
            return app('localization')->formatDate($this);
        });

        \Carbon\Carbon::macro('intlTimeFormat', function () {
            return app('localization')->formatTime($this);
        });

        \Carbon\Carbon::macro('intlDateTimeFormat', function () {
            return app('localization')->formatDateTime($this);
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'localization');

        // Register the main class to use with the facade
        $this->app->singleton('localization', function () {
            return new Localization;
        });
    }
}
