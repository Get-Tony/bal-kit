# Testing Guide

Comprehensive testing options for BAL Kit development and integration.

## 🧪 Testing Overview

BAL Kit provides comprehensive testing approaches to ensure reliability and compatibility:

- **Local Testing**: Direct testing on your local environment
- **PHPUnit Tests**: Unit and feature tests for the package itself
- **Integration Testing**: Real-world Laravel application testing
- **Quality Assurance**: Complete validation of all components

## 🚀 Quick Testing

### Local Testing (Comprehensive Quality Assurance)

```bash
# Run all tests
./test

# Run specific test categories
./test composer    # Test Composer dependencies
./test phpunit     # Run PHPUnit tests only
./test install     # Test package installation
./test frontend    # Test frontend compilation
./test laravel     # Test Laravel integration

# Test with specific version
./test --version "^1.5.0"

# Run with verbose output
./test --verbose
```

## 🔧 Local Testing Environment

### System Requirements

- **PHP 8.2+** with extensions: mbstring, xml, curl, zip, bcmath, intl
- **Composer 2.0+**
- **Node.js 18+** and NPM
- **Git** (for package installation)

### Environment Setup

```bash
# Verify PHP version and extensions
php --version
php -m | grep -E "(mbstring|xml|curl|zip|bcmath|intl)"

# Verify Composer
composer --version

# Verify Node.js and NPM
node --version
npm --version

# Check available memory
php -i | grep memory_limit
```

## 📊 Test Categories

### 1. Repository Access Tests

- Package availability on Packagist
- Version constraint validation
- Repository connectivity

### 2. Composer Dependency Tests

- Package installation from repository
- Dependency resolution
- Security vulnerability scanning
- Version compatibility checks

### 3. PHP Syntax Tests

- Syntax validation of all PHP files
- PSR-4 autoloading compliance
- Class instantiation tests

### 4. PHPUnit Tests

- **Feature Tests**: End-to-end functionality testing
- **Unit Tests**: Individual component testing
- **Coverage Reports**: Code coverage analysis

### 5. Laravel Integration Tests

- Fresh Laravel project creation
- Package installation (minimal, standard, full presets)
- Artisan command registration
- Route registration and functionality
- View compilation and caching
- Component resolution

### 6. Frontend Asset Tests

- NPM dependency installation
- Asset compilation (Vite/Webpack)
- SASS compilation
- JavaScript bundling
- Asset optimization

### 7. Performance Benchmarks

- Installation time measurement
- Asset compilation speed
- Memory usage analysis
- Load time optimization

## 🧪 PHPUnit Testing

### Running PHPUnit Tests

```bash
# Install dependencies first
composer install

# Run all tests
vendor/bin/phpunit

# Run specific test suites
vendor/bin/phpunit --testsuite=Feature
vendor/bin/phpunit --testsuite=Unit

# Run with coverage
vendor/bin/phpunit --coverage-html coverage/
vendor/bin/phpunit --coverage-text

# Run specific test file
vendor/bin/phpunit tests/Feature/InstallCommandTest.php
```

### Test Structure

```
tests/
├── Feature/
│   ├── InstallCommandTest.php      # Installation command tests
│   ├── ComponentRenderingTest.php  # Component rendering tests
│   └── AuthenticationTest.php      # Authentication flow tests
├── Unit/
│   ├── ConfigurationTest.php       # Configuration tests
│   ├── ServiceProviderTest.php     # Service provider tests
│   └── HelperTest.php              # Helper function tests
└── TestCase.php                    # Base test case
```

### Writing Tests

Example feature test:

```php
<?php
// tests/Feature/InstallCommandTest.php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InstallCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_install_command_with_minimal_preset()
    {
        $this->artisan('bal:install --preset=minimal')
             ->expectsOutput('Installing BAL Kit with minimal preset...')
             ->assertExitCode(0);

        // Assert files were created
        $this->assertFileExists(resource_path('js/app.js'));
        $this->assertFileExists(resource_path('sass/app.scss'));
    }

    public function test_install_command_with_full_preset()
    {
        $this->artisan('bal:install --preset=full')
             ->expectsOutput('Installing BAL Kit with full preset...')
             ->assertExitCode(0);

        // Assert authentication files were created
        $this->assertFileExists(resource_path('views/auth/login.blade.php'));
        $this->assertFileExists(resource_path('views/dashboard.blade.php'));
    }
}
```

Example unit test:

```php
<?php
// tests/Unit/ConfigurationTest.php

namespace Tests\Unit;

use Tests\TestCase;
use LaravelBalKit\BalKitServiceProvider;

class ConfigurationTest extends TestCase
{
    public function test_default_configuration_values()
    {
        $config = config('bal-kit');

        $this->assertEquals('1.5.0', $config['version']);
        $this->assertEquals('bal', $config['components']['prefix']);
        $this->assertTrue($config['auth']['enabled']);
    }

    public function test_component_namespace_configuration()
    {
        $namespace = config('bal-kit.components.namespace');

        $this->assertEquals('LaravelBalKit\\Components', $namespace);
    }
}
```

## 📈 Test Reporting

### Comprehensive Reports

Local testing provides detailed reports:

```
========================================
COMPREHENSIVE TEST REPORT
========================================

Test Configuration:
  📦 BAL Kit Version: ^1.5.0
  🔧 Test Mode: all

Test Execution Summary:
  📊 Total Tests Run: 18
  ✓ Passed: 18
  ✗ Failed: 0
  ⚠ Warnings: 1

  🎯 Success Rate: 100%

========================================
DETAILED TEST RESULTS
========================================

All Test Results:
  ✓ Repository Access - BAL Kit repository configured
  ✓ Composer - Package installation from repository
  ✓ Composer - Security audit passed
  ✓ PHP Syntax - All package files valid
  ✓ PHPUnit - Dependencies installed successfully
  ✓ PHPUnit - Feature tests passed
  ✓ PHPUnit - Unit tests passed
  ✓ Laravel Integration - Minimal preset installation
  ✓ Laravel Integration - Standard preset installation
  ✓ Laravel Integration - Full preset installation
  ✓ Frontend - NPM dependencies installed
  ✓ Frontend - Asset compilation successful
  ✓ Laravel Functionality - BAL Kit artisan commands registered
  ✓ Laravel Functionality - Route listing successful
  ✓ Laravel Functionality - Config caching successful
  ✓ Laravel Functionality - View caching successful
  ✓ Performance - Standard preset installation (3s)

Warnings Encountered:
  ⚠ Security audit completed with warnings

========================================
OVERALL STATUS
========================================
✅ Tests passed with 1 warnings. BAL Kit is functional but review warnings.
```

## 🔄 Continuous Integration

### GitHub Actions Integration

Example workflow for automated testing:

```yaml
# .github/workflows/test.yml
name: BAL Kit Tests

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main ]

jobs:
  local-tests:
    runs-on: ubuntu-latest

    strategy:
      matrix:
        php-version: [8.2, 8.3]
        laravel-version: [10, 11, 12]

    steps:
    - uses: actions/checkout@v4

    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: ${{ matrix.php-version }}
        extensions: mbstring, xml, curl, zip, bcmath, intl

    - name: Setup Node.js
      uses: actions/setup-node@v3
      with:
        node-version: '18'

    - name: Run Local Tests
      run: |
        chmod +x test
        ./test --version "^1.5.0"
```

## 🛡️ Security Testing

### Security Audit

Local testing environment includes security auditing:

```bash
# Composer security audit
composer audit

# NPM security audit
npm audit

# Check for known vulnerabilities
npm audit --audit-level moderate
```

### Dependency Scanning

```bash
# Check for outdated packages
composer outdated

# Check for platform requirements
composer check-platform-reqs

# Validate composer.json
composer validate
```

## 🔗 Related Documentation

- [Installation Guide](installation.md) - How to install BAL Kit
- [Configuration Guide](configuration.md) - Configure testing environment
- [Troubleshooting](troubleshooting.md) - Common testing issues
- [Version Management](version-management.md) - Version testing strategies
