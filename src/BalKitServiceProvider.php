<?php

namespace LaravelBalKit;

use Illuminate\Support\ServiceProvider;
use LaravelBalKit\Commands\InstallCommand;
use LaravelBalKit\Commands\PublishCommand;

class BalKitServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/bal-kit.php', 'bal-kit'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            // Register commands
            $this->commands([
                InstallCommand::class,
                PublishCommand::class,
            ]);

            // Publish config
            $this->publishes([
                __DIR__.'/../config/bal-kit.php' => config_path('bal-kit.php'),
            ], 'bal-kit-config');

            // Publish stubs
            $this->publishes([
                __DIR__.'/Stubs' => base_path('stubs/bal-kit'),
            ], 'bal-kit-stubs');
        }
    }
}
