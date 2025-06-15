# Installation Guide

Complete installation options and configuration for BAL Kit.

## 📦 Installation Methods

### Quick Installation (Recommended)

For most projects, use the standard preset:

```bash
composer require get-tony/bal-kit
php artisan bal:install --preset=standard
npm install && npm run build
```

### Preset Installations

Choose the preset that best fits your needs:

```bash
# Minimal setup (Bootstrap + Alpine only)
php artisan bal:install --preset=minimal

# Standard setup (Bootstrap + Alpine + Livewire + SASS)
php artisan bal:install --preset=standard

# Full setup (Everything + Authentication)
php artisan bal:install --preset=full
```

### Individual Components

Install specific components as needed:

```bash
# Install specific components
php artisan bal:install --bootstrap --alpine --livewire
php artisan bal:install --sass --auth
php artisan bal:install --bootstrap --alpine  # Just the frontend
```

### Advanced Publishing

For advanced users who need granular control:

```bash
# Publish configuration file
php artisan bal:publish --config

# Publish stub files for customization
php artisan bal:publish --stubs

# Publish example components
php artisan bal:publish --components

# List all available vendor:publish options
php artisan bal:publish --list
```

### Laravel-Native vendor:publish Support

Use Laravel's standard publishing system:

```bash
# Granular resource publishing (Laravel standard)
php artisan vendor:publish --tag=bal-kit-sass      # SASS architecture only
php artisan vendor:publish --tag=bal-kit-auth      # Authentication views only
php artisan vendor:publish --tag=bal-kit-layouts   # Layout templates only
php artisan vendor:publish --tag=bal-kit-js        # JavaScript files only
php artisan vendor:publish --tag=bal-kit-config    # Configuration only

# Publish everything using Laravel's vendor:publish
php artisan vendor:publish --provider="LaravelBalKit\BalKitServiceProvider"
```

## 🔧 Requirements

### System Requirements

- **Laravel 10+ or 12+**
- **PHP 8.2+**
- **Node.js 18+** and **NPM**
- **Composer 2.0+**

### Compatibility Matrix

| Laravel Version | PHP Version | Node.js Version | Status |
|----------------|-------------|-----------------|---------|
| 10.x           | 8.2+        | 18+             | ✅ Supported |
| 11.x           | 8.2+        | 18+             | ✅ Supported |
| 12.x           | 8.3+        | 18+             | ✅ Supported |

## 🚀 Step-by-Step Installation

### For New Projects

1. **Create Laravel Project**

   ```bash
   composer create-project laravel/laravel my-project
   cd my-project
   ```

2. **Install BAL Kit**

   ```bash
   composer require get-tony/bal-kit
   php artisan bal:install --preset=full
   ```

3. **Install Frontend Dependencies**

   ```bash
   npm install
   npm run build
   ```

4. **Start Development**

   ```bash
   php artisan serve
   ```

### For Existing Projects

1. **Install Package**

   ```bash
   composer require get-tony/bal-kit
   ```

2. **Choose Installation Method**

   ```bash
   # For projects without existing frontend
   php artisan bal:install --preset=standard

   # For projects with existing frontend (careful integration)
   php artisan bal:install --preset=minimal
   ```

3. **Update Dependencies**

   ```bash
   npm install
   npm run build
   ```

## ⚠️ Important Notes

- **Automatic Dependencies**: BAL Kit automatically installs and configures all required dependencies including Livewire, Bootstrap, and Alpine.js
- **No Manual Setup**: No manual dependency installation is required
- **Backup First**: Always backup your project before installation, especially for existing projects
- **Version Compatibility**: Ensure your Laravel version is compatible before installation

## 🔗 Next Steps

- [Configuration Guide](configuration.md) - Customize BAL Kit settings
- [Usage Examples](usage-examples.md) - Learn how to use components
- [Customization Guide](customization.md) - Modify and extend BAL Kit
- [Troubleshooting](troubleshooting.md) - Common issues and solutions
