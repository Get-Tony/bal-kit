# Changelog

All notable changes to BAL Kit will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.2.1] - 2025-01-15

### Fixed

- **Critical: Livewire Installation Issue**: Fixed "There are no commands defined in the 'livewire' namespace" error
  - Added proper package discovery after Livewire installation via Composer
  - Implemented check for existing Livewire installation to prevent duplicate installs
  - Added graceful error handling with manual installation instructions
  - Enhanced installation process with `config:clear` and `package:discover` commands
- **Documentation**: Updated README with better troubleshooting section for Livewire issues
- **SASS Warnings**: Added explanatory comments about Bootstrap 5.3+ deprecation warnings
  - Clarified that warnings come from Bootstrap itself, not BAL Kit
  - Added note that warnings don't affect functionality

### Enhanced

- **Installation Reliability**: More robust dependency installation process
- **Error Handling**: Better error messages and recovery instructions
- **User Experience**: Clearer feedback during installation process

### Technical Improvements

- **Dependency Management**: Improved Composer package detection and installation
- **Command Discovery**: Automatic Laravel command cache clearing after package installation
- **Error Recovery**: Fallback instructions for manual installation when automated process fails

## [1.2.0] - 2025-01-14

### Added - Complete Starter Kit Features

- **Authentication Pages**: Complete set of authentication forms with professional styling
  - Login form with remember me functionality and comprehensive error handling
  - Registration form with terms agreement and validation feedback
  - Forgot password form with status messages and user guidance
  - Password reset form with confirmation and security indicators
- **Dashboard Template**: Comprehensive dashboard with modern admin interface
  - Statistics cards with icons, colors, and progress indicators
  - Interactive chart placeholders (area chart and pie chart sections)
  - Recent activity feed with timestamps and status badges
  - Top performing products table with avatar icons
  - Quick action cards for common administrative tasks
  - Modal integration for new item creation with form validation
- **Profile Settings**: Multi-tab profile management interface
  - Personal information form with timezone selection and validation
  - Account settings with language/currency preferences and display options
  - Security tab with password change and two-factor authentication toggles
  - Notification preferences with granular email and push settings
  - Privacy settings with data sharing controls and visibility options
  - Account deletion with confirmation modal and safety checks
- **Reusable Blade Components**: Professional component library
  - Flexible card component with variants, shadows, and styling options
  - Advanced button component with icons, loading states, and tooltips
  - Alert component with auto-icons, dismissible functionality, and variants
  - Modal component with size options, centering, and accessibility features
- **Bootstrap Components Showcase**: Comprehensive demonstration page
  - Complete Bootstrap 5.3+ component library with live examples
  - Interactive table of contents with smooth scrolling navigation
  - Forms, tables, navigation, modals, and typography demonstrations
  - Progress bars, badges, spinners, accordion, and alert examples
  - Professional styling consistent with BAL Kit design system

### Enhanced

- **Layouts**: Added dedicated authentication layout with centered forms and professional styling
- **User Experience**: Implemented tab persistence, enhanced form interactions, and loading states
- **Documentation**: Updated package description to accurately reflect complete starter kit capabilities
- **File Organization**: Organized components into logical directories (auth/, pages/, components/, examples/)

### Technical Improvements

- **Component Architecture**: Implemented modular Blade components with comprehensive prop-based configuration
- **JavaScript Enhancements**: Added profile tab persistence, delete confirmation logic, and tooltip initialization
- **Accessibility**: Enhanced ARIA labels, screen reader support, and keyboard navigation
- **Professional Styling**: Consistent visual hierarchy, modern design patterns, and responsive layouts
- **Code Quality**: Clean, documented code with consistent naming conventions and best practices

### Directory Structure Updates

- Added `src/Stubs/auth/` directory for authentication page templates
- Added `src/Stubs/pages/` directory for main application pages
- Added `src/Stubs/components/` directory for reusable Blade components
- Added `src/Stubs/examples/` directory for component demonstrations

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
