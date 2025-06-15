# Laravel BAL Kit

[![Latest Version on Packagist](https://img.shields.io/packagist/v/get-tony/bal-kit.svg?style=flat-square)](https://packagist.org/packages/get-tony/bal-kit)
[![License: Proprietary](https://img.shields.io/badge/License-Proprietary-red.svg)](https://github.com/get-tony/bal-kit/blob/main/LICENSE)
[![Laravel](https://img.shields.io/badge/Laravel-10%2B%20%7C%2012-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://php.net)
[![Version](https://img.shields.io/badge/Version-1.5.2%20Stable-green.svg)](https://github.com/get-tony/bal-kit/releases/tag/v1.5.2)

A production-ready Laravel starter kit with **Bootstrap 5**, **Alpine.js**, and **Livewire 3** - the professional alternative to TALL stack for developers who prefer Bootstrap over Tailwind CSS.

## ✨ What is BAL Kit?

**BAL Kit** = **B**ootstrap + **A**lpine + **L**ivewire

A complete starter kit featuring:

- 🎨 **Bootstrap 5** - Professional UI components and responsive design
- 🏔️ **Alpine.js** - Lightweight reactivity (~15kB)
- ⚡ **Livewire 3** - Dynamic components without leaving PHP
- 🏗️ **7-1 SASS Architecture** - Organized, maintainable stylesheets
- 🔐 **Complete Authentication** - Login, registration, dashboard, profile management
- 🧩 **Reusable Components** - Professional Blade components ready to use

## 🚀 Quick Start

### New Project

```bash
composer create-project laravel/laravel my-app
cd my-app
composer require get-tony/bal-kit
php artisan bal:install --preset=full
npm install && npm run build
php artisan serve
```

### Existing Project

```bash
composer require get-tony/bal-kit
php artisan bal:install --preset=standard
npm install && npm run build
```

## 🎯 What You Get

- **Authentication System** - Complete login, registration, and password reset
- **Admin Dashboard** - Modern dashboard with statistics and activity feeds
- **Profile Management** - Multi-tab profile settings with security options
- **Professional Components** - Cards, buttons, alerts, modals with extensive customization
- **Bootstrap Showcase** - Comprehensive demo of all Bootstrap 5.3+ components

## 🔧 System Requirements

- **Laravel 10+ or 12+**
- **PHP 8.2+**
- **Node.js 18+** and **NPM**
- **Composer 2.0+**

> **Note:** All dependencies are automatically installed and configured.

## 📚 Documentation

### Quick Links

- **[📖 Complete Documentation](docs/README.md)** - Comprehensive guides and examples
- **[🚀 Installation Guide](docs/installation.md)** - Detailed installation options
- **[⚙️ Configuration](docs/configuration.md)** - Customize settings and behavior
- **[🎨 Usage Examples](docs/usage-examples.md)** - Code examples and patterns
- **[🔧 Customization](docs/customization.md)** - Modify and extend components

### Installation Presets

```bash
# Minimal (Bootstrap + Alpine only)
php artisan bal:install --preset=minimal

# Standard (+ Livewire + SASS)
php artisan bal:install --preset=standard

# Full (+ Authentication)
php artisan bal:install --preset=full
```

### Your First Component

```blade
<x-app-layout>
    <div class="container my-5">
        <x-bal-card title="Welcome to BAL Kit!">
            <p>Your Bootstrap + Alpine.js + Livewire application is ready.</p>

            <x-bal-button variant="primary" onclick="BalKit.toast('Hello!', 'success')">
                Show Toast
            </x-bal-button>
        </x-bal-card>
    </div>
</x-app-layout>
```

## 🧪 Testing & Quality Assurance

### Testing

```bash
# Run all tests locally
./test

# Test specific components
./test phpunit
./test frontend
./test composer
```

**[📋 Complete Testing Guide](docs/testing.md)** - Comprehensive testing documentation

## ⚠️ Important Notes

- **Do not run `php artisan breeze:install` manually** - BAL Kit handles authentication setup automatically with the `--preset=full` option
- **Use SASS, not CSS** - BAL Kit uses a 7-1 SASS architecture instead of plain CSS files
- **Bootstrap over Tailwind** - BAL Kit is designed as a Bootstrap alternative to TALL stack packages

## ⚖️ License & Commercial Use

**BAL Kit is proprietary software.** You may examine the source code for evaluation, but commercial use requires a license.

**For production or commercial projects:** Contact [get-tony@outlook.com](mailto:get-tony@outlook.com)

## 🌟 Key Features

### ✅ Production Ready (v1.5.0)

- **Comprehensive Testing** - Complete test suite for quality assurance
- **Air-Gapped Friendly** - No external dependencies
- **Enterprise Security** - Perfect for secure/isolated environments
- **Universal Compatibility** - Works with Laravel 10+, 11+, 12+

### 🎨 Professional UI

- **Bootstrap 5.3+** - Latest components and utilities
- **7-1 SASS Architecture** - Organized, maintainable stylesheets
- **Responsive Design** - Mobile-first approach
- **System Fonts** - No external font dependencies

### ⚡ Modern Stack

- **Livewire 3** - Dynamic server-side components
- **Alpine.js** - Lightweight client-side reactivity
- **Vite Integration** - Fast builds and hot reload
- **PHPUnit Ready** - Comprehensive test coverage

## 🚀 Version 1.5.2 Highlights

- 🔧 **Breeze Integration Fix** - Resolved CSS/SASS conflicts during installation
- 🚀 **Seamless Installation** - `--preset=full` now works without errors
- 📚 **Improved Documentation** - Clear warnings about manual Breeze installation
- 🛡️ **Conflict Prevention** - Automatic detection and resolution of asset conflicts
- ⚡ **Better Error Handling** - Clear guidance when installation issues occur

## 📞 Support & Resources

### 📚 Documentation

- **[Complete Documentation](docs/)** - Comprehensive guides
- **[Installation Guide](docs/installation.md)** - Step-by-step setup
- **[Testing Guide](docs/testing.md)** - Comprehensive testing
- **[Troubleshooting](docs/troubleshooting.md)** - Common issues

### 🔗 Links

- **[Packagist](https://packagist.org/packages/get-tony/bal-kit)** - Official package
- **[GitHub](https://github.com/get-tony/bal-kit)** - Source code
- **[Email Support](mailto:get-tony@outlook.com)** - Direct support

---

**Ready to get started?** Check out the [Installation Guide](docs/installation.md) or run `./test` to see BAL Kit in action!
