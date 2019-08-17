<?php

namespace Artixun\LaravelExceptionManager;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelExceptionManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadViewsFrom(
            __DIR__.'/../resources/views', 'laravel-exception-manager'
        );

        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-exception-manager.php' => config_path('laravel-exception-manager.php'),
            ], 'laravel-exception-manager-config');

            if (!class_exists('CreateErrorLogsTable')) {
                $this->publishes([
                    __DIR__.'/../database/migrations/create_error_logs_table.php.stub' =>
                        database_path('migrations/'.date('Y_m_d_His', time()).'_create_error_logs_table.php')
                ], 'laravel-exception-manager-migration');
            }

            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/laravel-exception-manager'),
            ], 'laravel-exception-manager-assets');
        }

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-exception-manager.php', 'laravel-exception-manager');

        // Register the main class to use with the facade
        $this->app->bind('laravel-exception-manager', function () {
            return new LaravelExceptionManager;
        });
    }

    /**
     * Get the Laravel Exception Manager route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'namespace' => 'Artixun\LaravelExceptionManager\Http\Controllers',
            'prefix' => config('laravel-exception-manager.path')
        ];
    }
}
