# Configuration Guide

Comprehensive configuration options for BAL Kit.

## 🎛️ Configuration File

BAL Kit uses a configuration file to manage settings and behavior.

### Publishing Configuration

```bash
php artisan bal:publish --config
```

This creates `config/bal-kit.php` with all available options.

### Default Configuration

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | BAL Kit Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration options for BAL Kit.
    | You can customize these settings to match your application's needs.
    |
    */

    'version' => '1.5.0',

    /*
    |--------------------------------------------------------------------------
    | Asset Configuration
    |--------------------------------------------------------------------------
    */
    'assets' => [
        'bootstrap' => [
            'version' => '5.3.2',
            'css_cdn' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
            'js_cdn' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
        ],
        'alpine' => [
            'version' => '3.13.3',
            'cdn' => 'https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Component Configuration
    |--------------------------------------------------------------------------
    */
    'components' => [
        'prefix' => 'bal',
        'namespace' => 'LaravelBalKit\\Components',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Configuration
    |--------------------------------------------------------------------------
    */
    'auth' => [
        'enabled' => true,
        'routes' => [
            'login' => '/login',
            'register' => '/register',
            'dashboard' => '/dashboard',
            'profile' => '/profile',
        ],
        'middleware' => ['web', 'auth'],
    ],

    /*
    |--------------------------------------------------------------------------
    | SASS Configuration
    |--------------------------------------------------------------------------
    */
    'sass' => [
        'architecture' => '7-1',
        'compile_path' => 'resources/sass',
        'output_path' => 'public/css',
    ],
];
```

## 🔧 Environment Variables

BAL Kit respects several environment variables for configuration:

```env
# BAL Kit Configuration
BAL_KIT_ENABLED=true
BAL_KIT_DEBUG=false
BAL_KIT_CACHE_VIEWS=true

# Asset Configuration
BAL_KIT_USE_CDN=false
BAL_KIT_BOOTSTRAP_VERSION=5.3.2
BAL_KIT_ALPINE_VERSION=3.13.3

# Authentication
BAL_KIT_AUTH_ENABLED=true
BAL_KIT_AUTH_MIDDLEWARE=web,auth
```

## 🎨 Customization Options

### Component Prefix

Change the component prefix from `bal` to your preferred prefix:

```php
'components' => [
    'prefix' => 'my-app', // Changes <x-bal-card> to <x-my-app-card>
],
```

### Asset Management

Configure how assets are loaded:

```php
'assets' => [
    'use_cdn' => env('BAL_KIT_USE_CDN', false),
    'local_path' => 'vendor/bal-kit/assets',
    'cache_bust' => true,
],
```

### Authentication Routes

Customize authentication routes:

```php
'auth' => [
    'routes' => [
        'login' => '/admin/login',
        'register' => '/admin/register',
        'dashboard' => '/admin/dashboard',
        'profile' => '/admin/profile',
    ],
],
```

## 🏗️ SASS Architecture Configuration

BAL Kit uses the 7-1 SASS architecture pattern:

```php
'sass' => [
    'architecture' => '7-1',
    'directories' => [
        'abstracts' => 'resources/sass/abstracts',
        'base' => 'resources/sass/base',
        'components' => 'resources/sass/components',
        'layout' => 'resources/sass/layout',
        'pages' => 'resources/sass/pages',
        'themes' => 'resources/sass/themes',
        'vendors' => 'resources/sass/vendors',
    ],
],
```

## 🔒 Security Configuration

### Content Security Policy

Configure CSP headers for BAL Kit assets:

```php
'security' => [
    'csp' => [
        'script_src' => [
            "'self'",
            "'unsafe-inline'", // Required for Alpine.js
            'cdn.jsdelivr.net',
        ],
        'style_src' => [
            "'self'",
            "'unsafe-inline'", // Required for Bootstrap
            'cdn.jsdelivr.net',
        ],
    ],
],
```

### Asset Integrity

Enable Subresource Integrity (SRI) for CDN assets:

```php
'assets' => [
    'integrity' => [
        'enabled' => true,
        'bootstrap_css' => 'sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN',
        'bootstrap_js' => 'sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL',
    ],
],
```

## 🌐 Localization

Configure multi-language support:

```php
'localization' => [
    'enabled' => true,
    'default_locale' => 'en',
    'supported_locales' => ['en', 'es', 'fr', 'de'],
    'fallback_locale' => 'en',
],
```

## 📱 Responsive Configuration

Configure responsive breakpoints:

```php
'responsive' => [
    'breakpoints' => [
        'xs' => '0px',
        'sm' => '576px',
        'md' => '768px',
        'lg' => '992px',
        'xl' => '1200px',
        'xxl' => '1400px',
    ],
],
```

## 🎯 Performance Configuration

Optimize BAL Kit performance:

```php
'performance' => [
    'cache_views' => env('BAL_KIT_CACHE_VIEWS', true),
    'minify_assets' => env('APP_ENV') === 'production',
    'lazy_load_components' => true,
    'preload_critical_css' => true,
],
```

## 🔧 Development Configuration

Settings for development environment:

```php
'development' => [
    'debug' => env('BAL_KIT_DEBUG', false),
    'show_component_names' => env('APP_DEBUG', false),
    'hot_reload' => env('VITE_HMR_HOST') !== null,
],
```

## 📊 Analytics Configuration

Configure analytics and tracking:

```php
'analytics' => [
    'enabled' => env('BAL_KIT_ANALYTICS', false),
    'google_analytics' => env('GOOGLE_ANALYTICS_ID'),
    'track_components' => false,
],
```

## 🔗 Related Documentation

- [Installation Guide](installation.md) - How to install BAL Kit
- [Customization Guide](customization.md) - Modify and extend BAL Kit
- [Usage Examples](usage-examples.md) - Learn component usage
- [Troubleshooting](troubleshooting.md) - Common configuration issues
