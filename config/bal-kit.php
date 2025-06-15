<?php

return [
    /*
    |--------------------------------------------------------------------------
    | BAL Kit Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration options for the Laravel BAL Kit.
    | BAL Kit provides Bootstrap + Alpine + Livewire components for Laravel.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Default Stack Components
    |--------------------------------------------------------------------------
    |
    | These options control which components are installed by default
    | when running the bal:install command.
    |
    */

    'install' => [
        'bootstrap' => true,
        'alpine' => true,
        'livewire' => true,
        'sass' => true,
        'auth' => false, // Install authentication scaffolding
    ],

    /*
    |--------------------------------------------------------------------------
    | Bootstrap Configuration
    |--------------------------------------------------------------------------
    |
    | Configure Bootstrap installation options.
    |
    */

    'bootstrap' => [
        'version' => '^5.3',
        'include_icons' => true, // Include Bootstrap Icons
        'include_popper' => true, // Include Popper.js for tooltips/dropdowns
    ],

    /*
    |--------------------------------------------------------------------------
    | Alpine.js Configuration
    |--------------------------------------------------------------------------
    |
    | Configure Alpine.js installation options.
    |
    */

    'alpine' => [
        'version' => '^3.14',
        'plugins' => [
            // 'intersect',
            // 'persist',
            // 'focus',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire Configuration
    |--------------------------------------------------------------------------
    |
    | Configure Livewire installation options.
    |
    */

    'livewire' => [
        'version' => '^3.0',
        'publish_config' => true,
        'create_layout' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | SASS Configuration
    |--------------------------------------------------------------------------
    |
    | Configure SASS/SCSS compilation options.
    |
    */

    'sass' => [
        'architecture' => '7-1', // Use 7-1 SASS architecture
        'directories' => [
            'abstracts',
            'base',
            'components',
            'layout',
            'vendors',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | File Paths
    |--------------------------------------------------------------------------
    |
    | Configure where BAL Kit files should be installed.
    |
    */

    'paths' => [
        'resources' => 'resources',
        'views' => 'resources/views',
        'sass' => 'resources/sass',
        'js' => 'resources/js',
        'components' => 'app/Livewire',
    ],

    /*
    |--------------------------------------------------------------------------
    | Preset Configurations
    |--------------------------------------------------------------------------
    |
    | Pre-configured setups for different use cases.
    |
    */

    'presets' => [
        'minimal' => [
            'bootstrap' => true,
            'alpine' => true,
            'livewire' => false,
            'sass' => false,
            'auth' => false,
        ],
        'standard' => [
            'bootstrap' => true,
            'alpine' => true,
            'livewire' => true,
            'sass' => true,
            'auth' => false,
        ],
        'full' => [
            'bootstrap' => true,
            'alpine' => true,
            'livewire' => true,
            'sass' => true,
            'auth' => true,
        ],
    ],
];
