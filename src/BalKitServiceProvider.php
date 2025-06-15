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
 * @version 1.4.6
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
        // Configuration file
        $this->publishes([
            __DIR__.'/../config/bal-kit.php' => config_path('bal-kit.php'),
        ], 'bal-kit-config');

        // SASS Architecture (7-1 structure)
        $this->publishes([
            __DIR__.'/Stubs/sass' => resource_path('sass'),
        ], 'bal-kit-sass');

        // JavaScript files
        $this->publishes([
            __DIR__.'/Stubs/js' => resource_path('js'),
        ], 'bal-kit-js');

        // Layout templates
        $this->publishes([
            __DIR__.'/Stubs/layouts' => resource_path('views/layouts'),
        ], 'bal-kit-layouts');

        // Component templates
        $this->publishes([
            __DIR__.'/Stubs/components' => resource_path('views/components'),
        ], 'bal-kit-components');

        // Authentication views
        $this->publishes([
            __DIR__.'/Stubs/auth' => resource_path('views/auth'),
        ], 'bal-kit-auth');

        // Example pages
        $this->publishes([
            __DIR__.'/Stubs/pages' => resource_path('views'),
        ], 'bal-kit-pages');

        // Vite configuration
        $this->publishes([
            __DIR__.'/Stubs/vite.config.js' => base_path('vite.config.js'),
        ], 'bal-kit-vite');

        // All stub files (for manual installation)
        $this->publishes([
            __DIR__.'/Stubs' => base_path('stubs/bal-kit'),
        ], 'bal-kit-stubs');

        // Everything (config + stubs) - default when using provider
        $this->publishes([
            __DIR__.'/../config/bal-kit.php' => config_path('bal-kit.php'),
            __DIR__.'/Stubs' => base_path('stubs/bal-kit'),
        ], 'bal-kit');
    }
}
