# Changelog

All notable changes to BAL Kit will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.0] - 2025-01-14

### Added

- Complete documentation consistency review and standardization
- Enhanced command documentation with full option descriptions
- Improved JavaScript utility documentation with Bootstrap context
- Added comprehensive application layout feature documentation
- Better Alpine.js component documentation with proper naming conventions

### Changed

- **BREAKING**: Simplified markdown documentation structure (removed UPGRADE.md and RELEASE_NOTES.md)
- Updated Alpine.js version to ^3.14 in configuration
- Improved README.md with more accurate and detailed information
- Enhanced code examples to match actual implementation
- Standardized all SASS file headers and documentation
- Clarified NPM script aliases and Vite integration

### Fixed

- **SASS Configuration**: Removed references to non-existent `pages/` and `themes/` directories
- **Version Consistency**: Aligned Alpine.js version across all documentation
- **Command Documentation**: Ensured all command options are properly documented
- **Code Examples**: All examples now use actual function names and components
- **Configuration Examples**: Match real config file structure

### Removed

- UPGRADE.md (installation instructions consolidated into README.md)
- RELEASE_NOTES.md (release information consolidated into CHANGELOG.md)
- Redundant documentation that required maintaining same information across multiple files

## [1.0.0] - 2025-01-14

### Added

- Initial release of BAL Kit for Laravel
- Bootstrap 5.3+ integration with professional styling
- Alpine.js 3.14+ integration for reactive components
- Livewire 3.0+ integration for server-side components
- 7-1 SASS architecture implementation
- Vite integration with hot module replacement
- Professional application layout with Bootstrap components
- Preset installation options (minimal, standard, full)
- Individual component installation support
- Configuration publishing capabilities
- Stub file publishing for customization
- Professional navigation bar with responsive design
- Flash message handling with Bootstrap alerts
- Footer with BAL Kit branding
- BAL Kit specific npm scripts (bal:dev, bal:build, bal:preview)
- Enhanced authentication installation with fallback options
- Interactive Breeze vs simple authentication choice
- Comprehensive troubleshooting section in README
- Modern SASS @use syntax support
- Error handling for authentication scaffolding
- Command refresh logic for Breeze installation
- Alternative simple Bootstrap authentication option

### Features

- **Installation Presets**:
  - `minimal`: Bootstrap + Alpine only
  - `standard`: Bootstrap + Alpine + Livewire + SASS
  - `full`: Everything + Authentication scaffolding
- **Component Integration**:
  - Bootstrap 5 with Popper.js for interactive components
  - Alpine.js for lightweight reactivity
  - Livewire for server-side components
  - SASS with organized 7-1 architecture
- **Laravel Integration**:
  - Service provider registration
  - Artisan command integration
  - Configuration file publishing
  - Asset compilation with Vite
- **Professional UI**:
  - Responsive Bootstrap layout
  - Modern typography with system fonts
  - Consistent spacing and styling
  - Professional color scheme
- **Authentication System**:
  - Bulletproof authentication installation
  - Support for Laravel Breeze integration
  - Fallback simple authentication option
  - Bootstrap-styled authentication forms
- **SASS Architecture**:
  - Modern @use syntax implementation
  - Bootstrap compilation compatibility
  - Reduced deprecation warnings
  - Organized 7-1 structure

### Fixed

- **Authentication Installation**: Robust `--preset=full` with "breeze namespace" error handling
  - Added proper command discovery after Breeze installation
  - Implemented graceful error handling with user guidance
  - Created alternative simple auth installation method
- **SASS Compilation**: Fixed Bootstrap compilation errors
  - Optimized for both @import and @use syntax compatibility
  - Resolved "Undefined mixin" errors during build process
  - Ensured all stub files use consistent syntax
  - Fixed asset compilation for production builds

### Requirements

- PHP 8.2+
- Laravel 10.0+ (supports Laravel 12)
- Node.js 18.0+
- NPM 8.0+

---

## Contributing

When contributing to this project, please:

1. Update the CHANGELOG.md file with your changes
2. Follow the [Keep a Changelog](https://keepachangelog.com/) format
3. Use semantic versioning for version numbers
4. Include migration notes for breaking changes

## License

BAL Kit is proprietary software. See [LICENSE](LICENSE) for details.
