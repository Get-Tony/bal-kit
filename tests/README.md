# BAL Kit Testing Suite

This directory contains Laravel-native tests using Orchestra Testbench, complementing the comprehensive integration test script in the project root.

## 🧪 **Test Structure**

### **Unit Tests** (`tests/Unit/`)

- **ServiceProviderTest.php** - Tests service provider registration, configuration merging, and preset definitions
- **CommandsTest.php** - Tests command signatures, options, and registration

### **Feature Tests** (`tests/Feature/`)

- **InstallCommandTest.php** - Tests `bal:install` command execution with various presets and options
- **PublishCommandTest.php** - Tests `bal:publish` command and Laravel's `vendor:publish` integration

## 🚀 **Running Tests**

### **All Tests**

```bash
vendor/bin/phpunit
```

### **Unit Tests Only**

```bash
vendor/bin/phpunit --testsuite=Unit
```

### **Feature Tests Only**

```bash
vendor/bin/phpunit --testsuite=Feature
```

### **With Coverage**

```bash
vendor/bin/phpunit --coverage-html coverage
```

## 📊 **Test Coverage**

The tests cover:

- ✅ Service provider registration and configuration
- ✅ Command registration and options
- ✅ Preset configurations (minimal, standard, full)
- ✅ Install command execution with all presets
- ✅ Publish command execution with all options
- ✅ Laravel's vendor:publish integration
- ✅ Error handling and edge cases

## 🔧 **Test Environment**

- **Framework**: Orchestra Testbench
- **Database**: SQLite in-memory
- **Configuration**: Isolated test environment
- **Dependencies**: Mocked where appropriate

## 🎯 **Comparison with Integration Tests**

| **Laravel-Native Tests** | **Integration Test Script** |
|--------------------------|------------------------------|
| ✅ **Fast** - Isolated environment | ✅ **Comprehensive** - Real-world testing |
| ✅ **Unit-focused** - Individual components | ✅ **End-to-end** - Complete installation flow |
| ✅ **CI/CD friendly** - Automated testing | ✅ **User-focused** - Actual usage scenarios |
| ✅ **Developer workflow** - Quick feedback | ✅ **Production validation** - Real environment |

## 🚀 **GitHub Actions**

Automated testing runs on:

- **PHP Versions**: 8.2, 8.3, 8.4
- **Laravel Versions**: 10.x, 11.x, 12.x
- **Dependency Versions**: prefer-lowest, prefer-stable
- **Integration Tests**: Real Laravel app installation

## 💡 **Best Practices**

1. **Keep tests focused** - Each test should verify one specific behavior
2. **Use descriptive names** - Test names should clearly describe what's being tested
3. **Avoid output testing** - Focus on behavior rather than exact output strings
4. **Test edge cases** - Include error conditions and boundary cases
5. **Maintain test isolation** - Each test should be independent

## 🔄 **Continuous Integration**

The test suite integrates with:

- **GitHub Actions** - Automated testing on push/PR
- **Codecov** - Code coverage reporting
- **Multiple PHP/Laravel versions** - Compatibility testing

This testing approach ensures BAL Kit maintains high quality while providing fast feedback during development.
