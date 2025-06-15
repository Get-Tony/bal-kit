# Version Management

Centralized version management system for BAL Kit.

## 🔧 Version System Overview

BAL Kit uses a centralized version management system that maintains consistency across all components while following Packagist best practices.

### Key Features

- **Single Source of Truth**: All version information centralized in `src/Version.php`
- **Packagist Compatible**: Uses Git tags for Packagist versioning
- **Automated Updates**: Scripts to update version references across documentation
- **CLI Access**: Command-line tools for version information
- **Fallback Support**: Graceful fallbacks for all version queries

## 📁 Version Architecture

```
├── src/Version.php                    # Central version class
├── scripts/version/
│   ├── version.php                   # CLI version helper
│   └── update-version-refs.sh       # Documentation updater
├── version                           # Root wrapper script
└── composer.json                     # No version (uses Git tags)
```

## 🎯 Central Version Class

### Location and Structure

```php
<?php
// src/Version.php

namespace LaravelBalKit;

class Version
{
    /**
     * Current BAL Kit version
     */
    public const VERSION = '1.5.0';

    /**
     * Version constraint for Composer
     */
    public const CONSTRAINT = '^1.5.0';

    /**
     * Release date
     */
    public const RELEASE_DATE = '2025-01-27';

    /**
     * Release codename
     */
    public const CODENAME = 'Docker Testing Environment';

    /**
     * Get formatted version string
     */
    public static function getVersion(): string
    {
        return self::VERSION;
    }

    /**
     * Get version constraint for Composer
     */
    public static function getConstraint(): string
    {
        return self::CONSTRAINT;
    }

    /**
     * Get full version information
     */
    public static function getFullInfo(): array
    {
        return [
            'version' => self::VERSION,
            'constraint' => self::CONSTRAINT,
            'release_date' => self::RELEASE_DATE,
            'codename' => self::CODENAME,
        ];
    }
}
```

## 🖥️ CLI Version Tools

### Version Command

```bash
# Get current version
./version

# Get version constraint
./version --constraint

# Get full version info
./version --info

# Get help
./version --help
```

### CLI Implementation

```php
<?php
// scripts/version/version.php

require_once __DIR__ . '/../../vendor/autoload.php';

use LaravelBalKit\Version;

$command = $argv[1] ?? 'version';

switch ($command) {
    case '--constraint':
    case '-c':
        echo Version::getConstraint() . PHP_EOL;
        break;

    case '--info':
    case '-i':
        $info = Version::getFullInfo();
        echo "BAL Kit Version Information:" . PHP_EOL;
        echo "  Version: " . $info['version'] . PHP_EOL;
        echo "  Constraint: " . $info['constraint'] . PHP_EOL;
        echo "  Release Date: " . $info['release_date'] . PHP_EOL;
        echo "  Codename: " . $info['codename'] . PHP_EOL;
        break;

    case '--help':
    case '-h':
        echo "BAL Kit Version Manager" . PHP_EOL;
        echo "" . PHP_EOL;
        echo "Usage: ./version [option]" . PHP_EOL;
        echo "" . PHP_EOL;
        echo "Options:" . PHP_EOL;
        echo "  (none)           Show current version" . PHP_EOL;
        echo "  -c, --constraint Show version constraint" . PHP_EOL;
        echo "  -i, --info       Show full version information" . PHP_EOL;
        echo "  -h, --help       Show this help message" . PHP_EOL;
        break;

    default:
        echo Version::getVersion() . PHP_EOL;
        break;
}
```

## 🔄 Automated Documentation Updates

### Update Script

The `update-version-refs.sh` script automatically updates version references across documentation:

```bash
#!/bin/bash
# scripts/version/update-version-refs.sh

set -e

# Get current version from Version.php
VERSION=$(php scripts/version/version.php)
CONSTRAINT=$(php scripts/version/version.php --constraint)

echo "Updating version references to: $VERSION"
echo "Using constraint: $CONSTRAINT"

# Update README.md
sed -i "s/Version-[0-9]\+\.[0-9]\+\.[0-9]\+/Version-$VERSION/g" README.md
sed -i "s/get-tony\/bal-kit:[^\"]*\"/get-tony\/bal-kit:\"$CONSTRAINT\"/g" README.md

# Update CHANGELOG.md
if ! grep -q "## \[$VERSION\]" CHANGELOG.md; then
    echo "Adding new version entry to CHANGELOG.md"
    # Add new version entry logic here
fi

# Update documentation files
find docs/ -name "*.md" -exec sed -i "s/get-tony\/bal-kit:[^\"]*\"/get-tony\/bal-kit:\"$CONSTRAINT\"/g" {} \;

# Update test scripts
find scripts/ -name "*.sh" -exec sed -i "s/DEFAULT_VERSION=\"[^\"]*\"/DEFAULT_VERSION=\"$CONSTRAINT\"/g" {} \;

echo "Version references updated successfully!"
```

### Running Updates

```bash
# Update all version references
./scripts/version/update-version-refs.sh

# Or use the wrapper
./version --update-refs
```

## 📦 Packagist Integration

### Git Tag Strategy

BAL Kit follows Packagist best practices:

1. **No version in composer.json**: Packagist reads versions from Git tags
2. **Semantic versioning**: All tags follow semver (v1.5.0, v1.5.1, etc.)
3. **Centralized source**: Version class provides single source of truth

### Release Process

```bash
# 1. Update version in src/Version.php
# 2. Update documentation references
./scripts/version/update-version-refs.sh

# 3. Commit changes
git add .
git commit -m "Release v1.5.0"

# 4. Create and push tag
git tag -a v1.5.0 -m "Release v1.5.0 - Docker Testing Environment"
git push origin v1.5.0

# 5. Packagist automatically detects the new version
```

## 🔧 Integration with Testing Scripts

### Native Testing

```bash
# test-bal-kit.sh uses centralized version
DEFAULT_VERSION=$(php scripts/version/version.php --constraint 2>/dev/null || echo "^1.5.0")
VERSION="${DEFAULT_VERSION}"
```

### Docker Testing

```bash
# docker-test-runner.sh reads from central source
get_version() {
    if [ -f "scripts/version/version.php" ]; then
        php scripts/version/version.php --constraint 2>/dev/null || echo "^1.5.0"
    else
        echo "^1.5.0"
    fi
}

DEFAULT_VERSION=$(get_version)
```

### Local Testing

```bash
# scripts/testing/local-test.sh with fallback
get_bal_kit_version() {
    # Try to get version from Version.php
    if [ -f "src/Version.php" ]; then
        php -r "
        require_once 'src/Version.php';
        echo LaravelBalKit\Version::getConstraint();
        " 2>/dev/null || echo "^1.5.0"
    else
        echo "^1.5.0"
    fi
}
```

## 🛡️ Fallback Mechanisms

### Graceful Degradation

All scripts include fallback mechanisms:

```bash
# Primary: Read from Version.php
VERSION=$(php scripts/version/version.php --constraint 2>/dev/null)

# Fallback 1: Default constraint
if [ -z "$VERSION" ]; then
    VERSION="^1.5.0"
fi

# Fallback 2: Environment variable
VERSION="${BAL_KIT_VERSION:-$VERSION}"

# Fallback 3: Command line argument
VERSION="${1:-$VERSION}"
```

### Error Handling

```bash
get_version_safe() {
    local version

    # Try multiple methods
    if command -v php >/dev/null 2>&1 && [ -f "scripts/version/version.php" ]; then
        version=$(php scripts/version/version.php --constraint 2>/dev/null)
    fi

    # Fallback to hardcoded version
    if [ -z "$version" ]; then
        version="^1.5.0"
    fi

    echo "$version"
}
```

## 📊 Version Compatibility Matrix

### Laravel Compatibility

| BAL Kit Version | Laravel 10.x | Laravel 11.x | Laravel 12.x | PHP Version |
|----------------|--------------|--------------|--------------|-------------|
| 1.5.x          | ✅ Supported | ✅ Supported | ✅ Supported | 8.2+        |
| 1.4.x          | ✅ Supported | ✅ Supported | ❌ Not Tested | 8.2+        |
| 1.3.x          | ✅ Supported | ❌ Not Tested | ❌ Not Tested | 8.1+        |

### Dependency Versions

```json
{
    "require": {
        "php": "^8.2",
        "laravel/framework": "^10.0|^11.0|^12.0",
        "livewire/livewire": "^3.0"
    },
    "require-dev": {
        "phpunit/phpunit": "^10.0|^11.0"
    }
}
```

## 🔄 Version Update Workflow

### Development Workflow

1. **Feature Development**: Work on new features
2. **Version Planning**: Decide on version number (semver)
3. **Update Version Class**: Modify `src/Version.php`
4. **Update Documentation**: Run update script
5. **Testing**: Run comprehensive tests
6. **Release**: Create Git tag and push

### Automated Checks

```bash
# Pre-commit hook example
#!/bin/bash
# .git/hooks/pre-commit

# Check if version was updated in Version.php
if git diff --cached --name-only | grep -q "src/Version.php"; then
    echo "Version.php updated, running documentation update..."
    ./scripts/version/update-version-refs.sh

    # Add updated files to commit
    git add README.md CHANGELOG.md docs/
fi
```

## 🔗 Related Documentation

- [Installation Guide](installation.md) - Version-specific installation
- [Testing Guide](testing.md) - Version testing strategies
- [Configuration Guide](configuration.md) - Version configuration
- [Troubleshooting](troubleshooting.md) - Version-related issues
