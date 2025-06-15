# Troubleshooting Guide

Common issues and solutions when working with BAL Kit.

## 🚨 Installation Issues

### Composer Installation Fails

**Problem**: `composer require get-tony/bal-kit` fails with dependency conflicts.

**Solutions**:

```bash
# Update Composer first
composer self-update

# Clear Composer cache
composer clear-cache

# Try with specific version
composer require get-tony/bal-kit:^1.5.0

# Force update if needed
composer update --with-all-dependencies
```

### Artisan Command Not Found

**Problem**: `php artisan bal:install` command not recognized.

**Solutions**:

```bash
# Clear application cache
php artisan cache:clear
php artisan config:clear

# Dump autoload
composer dump-autoload

# Check if package is properly installed
composer show get-tony/bal-kit
```

### Permission Errors During Installation

**Problem**: Permission denied when publishing assets.

**Solutions**:

```bash
# Fix directory permissions
sudo chown -R $USER:$USER storage bootstrap/cache
chmod -R 755 storage bootstrap/cache

# For resources directory
sudo chown -R $USER:$USER resources
chmod -R 755 resources
```

## 🎨 Frontend Issues

### NPM Install Fails

**Problem**: `npm install` fails after BAL Kit installation.

**Solutions**:

```bash
# Clear NPM cache
npm cache clean --force

# Delete node_modules and package-lock.json
rm -rf node_modules package-lock.json

# Reinstall
npm install

# Try with legacy peer deps if needed
npm install --legacy-peer-deps
```

### Vite Build Errors

**Problem**: `npm run build` fails with compilation errors.

**Solutions**:

```bash
# Check Vite configuration
cat vite.config.js

# Clear Vite cache
rm -rf node_modules/.vite

# Rebuild with verbose output
npm run build -- --debug

# Check for SASS syntax errors
npm run dev
```

### Assets Not Loading

**Problem**: CSS/JS assets not loading in browser.

**Solutions**:

```bash
# Rebuild assets
npm run build

# Check public directory permissions
ls -la public/build/

# Clear Laravel cache
php artisan view:clear
php artisan route:clear
php artisan config:clear

# Check APP_URL in .env
grep APP_URL .env
```

## 🔧 Component Issues

### Components Not Rendering

**Problem**: BAL Kit components show as plain text.

**Solutions**:

```bash
# Check if Blade components are registered
php artisan view:cache
php artisan view:clear

# Verify component namespace in config
php artisan config:show bal-kit.components

# Check component files exist
ls -la resources/views/components/bal/
```

### Livewire Integration Problems

**Problem**: Livewire components not working with BAL Kit.

**Solutions**:

```bash
# Publish Livewire assets
php artisan livewire:publish --config
php artisan livewire:publish --assets

# Check Livewire version compatibility
composer show livewire/livewire

# Clear Livewire cache
php artisan livewire:discover
```

### Alpine.js Not Working

**Problem**: Alpine.js directives not functioning.

**Solutions**:

```html
<!-- Check if Alpine.js is loaded -->
<script>
console.log('Alpine version:', Alpine.version);
</script>

<!-- Ensure proper initialization order -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Check for JavaScript errors -->
<!-- Open browser console (F12) and look for errors -->
```

## 🔐 Authentication Issues

### Auth Routes Not Working

**Problem**: Authentication routes return 404 errors.

**Solutions**:

```bash
# Check if auth routes are registered
php artisan route:list | grep auth

# Clear route cache
php artisan route:clear

# Republish auth views
php artisan bal:install --auth --force

# Check middleware configuration
php artisan config:show auth
```

### Login Redirects Not Working

**Problem**: After login, redirects to wrong page.

**Solutions**:

```php
// Check RouteServiceProvider.php
// app/Providers/RouteServiceProvider.php
public const HOME = '/dashboard'; // Update this

// Or in LoginController
protected $redirectTo = '/dashboard';

// Check middleware in routes
Route::middleware(['auth'])->group(function () {
    // Your protected routes
});
```

### Session Issues

**Problem**: Users getting logged out frequently.

**Solutions**:

```bash
# Check session configuration
php artisan config:show session

# Clear sessions
php artisan session:table # if using database
php artisan migrate

# Check .env session settings
grep SESSION .env
```

## 🎯 Performance Issues

### Slow Page Loading

**Problem**: Pages load slowly with BAL Kit.

**Solutions**:

```bash
# Optimize assets
npm run build

# Enable caching
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Check for N+1 queries
# Install Laravel Debugbar
composer require barryvdh/laravel-debugbar --dev
```

### Large Bundle Size

**Problem**: JavaScript/CSS bundles are too large.

**Solutions**:

```javascript
// vite.config.js - Enable tree shaking
export default defineConfig({
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['bootstrap', 'alpinejs'],
                    bal: ['./resources/js/bal-kit.js']
                }
            }
        }
    }
});
```

### Memory Issues

**Problem**: PHP memory limit exceeded.

**Solutions**:

```bash
# Increase memory limit temporarily
php -d memory_limit=512M artisan bal:install

# Or update php.ini
memory_limit = 512M

# Check current limit
php -i | grep memory_limit
```

## 🐛 Common Errors

### Class Not Found Errors

**Problem**: `Class 'LaravelBalKit\...' not found`

**Solutions**:

```bash
# Regenerate autoload files
composer dump-autoload

# Check if package is in vendor
ls -la vendor/get-tony/bal-kit/

# Verify composer.json
cat composer.json | grep bal-kit
```

### View Not Found Errors

**Problem**: `View [components.bal.card] not found`

**Solutions**:

```bash
# Check view paths
php artisan view:clear

# Verify component files
ls -la resources/views/components/bal/

# Republish components
php artisan bal:publish --components --force
```

### CSRF Token Mismatch

**Problem**: CSRF token mismatch in forms.

**Solutions**:

```blade
<!-- Ensure CSRF token is included -->
<form method="POST">
    @csrf
    <!-- form fields -->
</form>

<!-- For AJAX requests -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
```

## 🔍 Debugging Tips

### Enable Debug Mode

```bash
# .env file
APP_DEBUG=true
APP_ENV=local

# Clear config cache
php artisan config:clear
```

### Check Laravel Logs

```bash
# View recent logs
tail -f storage/logs/laravel.log

# Check specific error
grep "ERROR" storage/logs/laravel.log
```

### Browser Developer Tools

1. **Console Tab**: Check for JavaScript errors
2. **Network Tab**: Verify asset loading
3. **Elements Tab**: Inspect component rendering
4. **Application Tab**: Check localStorage/sessionStorage

### Artisan Commands for Debugging

```bash
# Check application status
php artisan about

# List all routes
php artisan route:list

# Check configuration
php artisan config:show

# Test database connection
php artisan migrate:status

# Check queue status
php artisan queue:work --once
```

## 📞 Getting Help

### Before Reporting Issues

1. **Check Laravel Version**: Ensure compatibility
2. **Update Dependencies**: Run `composer update`
3. **Clear All Caches**: Run cache clear commands
4. **Check Error Logs**: Review Laravel logs
5. **Test in Fresh Install**: Verify issue in clean environment

### Information to Include

When reporting issues, include:

- Laravel version (`php artisan --version`)
- PHP version (`php --version`)
- BAL Kit version (`composer show get-tony/bal-kit`)
- Node.js version (`node --version`)
- Complete error message
- Steps to reproduce
- Relevant configuration files

### Support Channels

- **Documentation**: Check all documentation files
- **GitHub Issues**: For bug reports and feature requests
- **Email Support**: [get-tony@outlook.com](mailto:get-tony@outlook.com)

## 🔗 Related Documentation

- [Installation Guide](installation.md) - Proper installation steps
- [Configuration Guide](configuration.md) - Configuration options
- [Usage Examples](usage-examples.md) - Working examples
- [Customization Guide](customization.md) - Customization options
