<?php

namespace Artixun\LaravelExceptionManager;

use Illuminate\Support\ServiceProvider;

class LaravelExceptionManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-exception-manager.php'),
            ], 'laravel-exception-manager-config');

            if (!class_exists('CreateErrorLogsTable')) {
                $this->publishes([
                    __DIR__.'/../database/migrations/create_error_logs_table.php.stub' =>
                        database_path('migrations/'.date('Y_m_d_His', time()).'_create_error_logs_table.php')
                ], 'laravel-exception-manager-migration');
            }
        }

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-exception-manager');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-exception-manager', function () {
            return new LaravelExceptionManager;
        });
    }

//    protected function pushDatabaseHandlerToLogger()
//    {
//        $logWriter = $this->app->make(LoggerInterface::class);
//        $logger = $logWriter->getMonolog();
//
//        $slackHandler = new SlackWebhookHandler($webhookUrl, null, null, true, null, false, true, $this->getlogLevel($logger));
//        $slackHandler = $this->pushProcessors($slackHandler);
//        $logger->pushHandler($slackHandler);
//    }
}
