# Installation Guide

BAL Kit v1.0.0 is the **initial release** of the Bootstrap + Alpine + Livewire starter kit for Laravel.

## Fresh Installation

### New Laravel Project

```bash
# Create a fresh Laravel project with BAL Kit
composer create-project laravel/laravel my-app
cd my-app
composer require get-tony/bal-kit
php artisan bal:install --preset=standard
npm install && npm run dev
php artisan serve
```

### Existing Laravel Project

```bash
# Add BAL Kit to existing project
composer require get-tony/bal-kit
php artisan bal:install --preset=standard
npm install && npm run dev
```

## Installation Presets

Choose the preset that best fits your needs:

### Minimal Preset

```bash
# Bootstrap + Alpine.js only
php artisan bal:install --preset=minimal
```

**Includes:**

- ✅ Bootstrap 5.3+ CSS and JavaScript
- ✅ Alpine.js 3.14+ for reactivity
- ✅ Basic layout structure
- ✅ Vite configuration

### Standard Preset (Recommended)

```bash
# Bootstrap + Alpine + Livewire + SASS
php artisan bal:install --preset=standard
```

**Includes:**

- ✅ Everything from Minimal preset
- ✅ Livewire 3.0+ integration
- ✅ 7-1 SASS architecture
- ✅ Professional layouts
- ✅ Flash message handling

### Full Preset

```bash
# Everything + Authentication scaffolding
php artisan bal:install --preset=full
```

**Includes:**

- ✅ Everything from Standard preset
- ✅ Laravel Breeze authentication
- ✅ Bootstrap-styled auth forms
- ✅ Authentication layouts
- ✅ User registration and login

## Individual Components

Install specific components as needed:

```bash
# Frontend only
php artisan bal:install --bootstrap --alpine

# Add Livewire
php artisan bal:install --livewire

# Add SASS architecture
php artisan bal:install --sass

# Add authentication
php artisan bal:install --auth
```

## Configuration & Customization

### Publish Configuration

```bash
# Publish the config file for customization
php artisan bal:publish --config
```

### Publish Stubs

```bash
# Publish SASS, JavaScript, and layout stubs
php artisan bal:publish --stubs
```

### Publish Components

```bash
# Publish example Livewire components
php artisan bal:publish --components
```

## Post-Installation

### 1. Install NPM Dependencies

```bash
npm install
```

### 2. Build Assets

```bash
# Development build with watch
npm run dev

# Or production build
npm run build
```

### 3. Start Development Server

```bash
php artisan serve
```

### 4. Verify Installation

Visit `http://localhost:8000` and you should see:

- ✅ Bootstrap-styled layout
- ✅ Working navigation
- ✅ Flash message system
- ✅ Responsive design

## NPM Scripts

BAL Kit adds these convenient npm scripts:

```bash
npm run bal:dev      # Start development with hot reload
npm run bal:build    # Build for production
npm run bal:preview  # Preview production build
```

## Troubleshooting

### Common Issues

**Command not found**: Ensure you've run `composer require get-tony/bal-kit`

**Asset build errors**: Make sure you have Node.js 18+ and npm 8+

```bash
node --version    # Should be 18.0+
npm --version     # Should be 8.0+
```

**Authentication issues**: For `--preset=full`, ensure your Laravel project supports Breeze:

```bash
# Check Laravel version
php artisan --version    # Should be 10.0+
```

**SASS compilation errors**: Ensure all dependencies are installed:

```bash
npm install
npm run build
```

### Getting Help

- **Documentation**: Complete usage examples in README.md
- **Email Support**: [get-tony@outlook.com](mailto:get-tony@outlook.com)
- **GitHub Issues**: [Report problems](https://github.com/get-tony/bal-kit/issues)

## Requirements

- **PHP**: 8.2 or higher
- **Laravel**: 10.0 or higher (supports Laravel 12)
- **Node.js**: 18.0 or higher
- **NPM**: 8.0 or higher

## What's Next?

After installation, explore:

1. **SASS Architecture** - Customize Bootstrap variables in `resources/sass/abstracts/_variables.scss`
2. **Alpine Components** - Add reactive components using Alpine.js
3. **Livewire Integration** - Build dynamic server-side components
4. **Bootstrap Components** - Use the full Bootstrap component library

---

**Welcome to BAL Kit! 🚀**

> Bootstrap + Alpine + Livewire = The perfect TALL stack alternative!
