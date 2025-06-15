<?php

namespace LaravelBalKit;

use Illuminate\Support\ServiceProvider;
use LaravelBalKit\Commands\InstallCommand;
use LaravelBalKit\Commands\PublishCommand;

/**
 * BAL Kit Service Provider
 *
 * Bootstrap + Alpine.js + Livewire toolkit for Laravel
 * Provides installation commands and resource publishing
 *
 * @version 1.2.1
 */
class BalKitServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Merge package configuration with application config
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
            $this->registerCommands();
            $this->registerPublishables();
        }
    }

    /**
     * Register Artisan commands.
     */
    protected function registerCommands(): void
    {
        $this->commands([
            InstallCommand::class,
            PublishCommand::class,
        ]);
    }

    /**
     * Register publishable resources.
     */
    protected function registerPublishables(): void
    {
        // Publish configuration file
        $this->publishes([
            __DIR__.'/../config/bal-kit.php' => config_path('bal-kit.php'),
        ], 'bal-kit-config');

        // Publish stub files (SASS, JS, layouts)
        $this->publishes([
            __DIR__.'/Stubs' => base_path('stubs/bal-kit'),
        ], 'bal-kit-stubs');

        // Publish all resources
        $this->publishes([
            __DIR__.'/../config/bal-kit.php' => config_path('bal-kit.php'),
            __DIR__.'/Stubs' => base_path('stubs/bal-kit'),
        ], 'bal-kit');
    }
}
