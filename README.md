# Laravel BAL Kit

[![Latest Version on Packagist](https://img.shields.io/packagist/v/get-tony/bal-kit.svg?style=flat-square)](https://packagist.org/packages/get-tony/bal-kit)
[![License: Proprietary](https://img.shields.io/badge/License-Proprietary-red.svg)](https://github.com/get-tony/bal-kit/blob/main/LICENSE)
[![Laravel](https://img.shields.io/badge/Laravel-10%2B%20%7C%2012-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://php.net)

A complete Laravel starter kit with **Bootstrap**, **Alpine.js**, and **Livewire** featuring authentication pages, admin dashboard, profile settings, and reusable components - the perfect alternative to TALL stack for developers who prefer Bootstrap over Tailwind CSS.

## ⚖️ Licensing Notice

**BAL Kit is proprietary software.** You may view and examine the source code for evaluation purposes, but commercial use requires a separate license. For production use or commercial projects, please contact [get-tony@outlook.com](mailto:get-tony@outlook.com) for licensing information.

## ✨ What is BAL Kit?

**BAL Kit** = **B**ootstrap + **A**lpine + **L**ivewire

- 🎨 **Bootstrap 5** - World's most popular CSS framework with professional components
- 🏔️ **Alpine.js** - Lightweight, reactive JavaScript framework (only ~15kB)
- ⚡ **Livewire 3** - Dynamic Laravel components without leaving PHP
- 🏗️ **7-1 SASS Architecture** - Organized, maintainable stylesheets
- 🚀 **Vite Integration** - Fast builds and hot module replacement

## 🚀 Quick Start

### Install in Existing Laravel Project

```bash
composer require get-tony/bal-kit
php artisan bal:install --preset=standard
npm install && npm run dev
```

### Fresh Laravel Project

```bash
composer create-project laravel/laravel my-app
cd my-app
composer require get-tony/bal-kit
php artisan bal:install --preset=full
npm install && npm run dev
php artisan serve
```

### 🔧 Requirements

- **Laravel 10+ or 12+**
- **PHP 8.2+**
- **Node.js 18+** and **NPM**
- **Composer 2.0+**

> **Note:** BAL Kit automatically installs and configures all required dependencies including Livewire, Bootstrap, and Alpine.js. No manual dependency installation is required.

## 📦 Installation Options

### Preset Installations

```bash
# Minimal setup (Bootstrap + Alpine only)
php artisan bal:install --preset=minimal

# Standard setup (Bootstrap + Alpine + Livewire + SASS)
php artisan bal:install --preset=standard

# Full setup (Everything + Authentication)
php artisan bal:install --preset=full
```

### Individual Components

```bash
# Install specific components
php artisan bal:install --bootstrap --alpine --livewire
php artisan bal:install --sass --auth
php artisan bal:install --bootstrap --alpine  # Just the frontend
```

### Configuration

```bash
# Publish configuration file
php artisan bal:publish --config

# Publish stub files for customization
php artisan bal:publish --stubs

# Publish example components
php artisan bal:publish --components
```

## 🎯 What You Get

### Complete Starter Kit (v1.2.0+)

- **Authentication Pages** - Professional login, registration, forgot password, and reset forms
- **Admin Dashboard** - Modern dashboard with statistics cards, charts, activity feeds, and quick actions
- **Profile Settings** - Multi-tab profile management with personal info, security, notifications, and privacy
- **Reusable Components** - Professional Blade components (cards, buttons, alerts, modals) with extensive options
- **Bootstrap Showcase** - Comprehensive demo page with all Bootstrap 5.3+ components and examples

### Professional UI Foundation

- **Responsive Bootstrap 5** components out of the box
- **System font stacks** - No external font dependencies
- **7-1 SASS architecture** - Organized stylesheets
- **Modern form styling** - Enhanced Bootstrap form controls
- **Consistent spacing** - Utility classes for rapid development

### JavaScript Toolkit

- **Alpine.js integration** - Reactive components and data binding
- **Bootstrap JavaScript** - All interactive components (modals, dropdowns, etc.)
- **BAL Kit utilities** - Toast notifications, confirm dialogs, and more
- **Livewire compatibility** - Seamless server-side components

### Laravel Integration

- **Professional layouts** - Application layout with Bootstrap navbar, flash messages, and footer
- **Flash message handling** - Automatic Bootstrap alert styling for session feedback
- **Authentication options** - Bootstrap-styled auth forms with optional Laravel Breeze integration for complete functionality
- **Organized structure** - Livewire components with clear organization
- **Vite configuration** - Optimized build setup with Bootstrap alias and hot reload

## 🛠️ Available Commands

```bash
# Installation and setup
php artisan bal:install [options]     # Install BAL Kit components
  --bootstrap                          # Install Bootstrap CSS framework
  --alpine                             # Install Alpine.js
  --livewire                           # Install Livewire
  --sass                               # Setup SASS with 7-1 architecture
  --auth                               # Install authentication scaffolding
  --preset=minimal|standard|full       # Use preset configuration
  --force                              # Overwrite existing files

php artisan bal:publish [options]     # Publish resources
  --config                             # Publish configuration file
  --stubs                              # Publish stub files
  --components                         # Publish example components
  --all                                # Publish all resources
  --force                              # Overwrite existing files

# NPM scripts (added to package.json)
npm run bal:dev                       # Start development server with hot reload
npm run bal:build                     # Build for production
npm run bal:preview                   # Preview production build
```

## 🎨 Usage Examples

### Application Layout Features

The main application layout (`resources/views/layouts/app.blade.php`) includes:

- **Responsive Bootstrap navbar** with authentication links
- **Automatic flash message display** for success, error, and validation messages
- **Professional footer** with BAL Kit branding
- **Flexible content slot** supporting both `$slot` and `$content` variables
- **Livewire integration** with `@livewireStyles` and `@livewireScripts`
- **Vite asset loading** with automatic SASS and JS compilation

### Alpine.js Components

BAL Kit includes pre-built Alpine.js components that work seamlessly with Bootstrap:

```html
<!-- Modal Component (uses balModal Alpine component) -->
<div x-data="balModal()">
    <button @click="open()" class="btn btn-primary">Open Modal</button>

    <div x-show="show" class="modal fade show" style="display: block;" x-transition>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Title</h5>
                    <button @click="close()" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    Modal content goes here...
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabs Component (uses balTabs Alpine component) -->
<div x-data="balTabs(0)">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <button @click="setActive(0)" :class="isActive(0) ? 'nav-link active' : 'nav-link'">Tab 1</button>
        </li>
        <li class="nav-item">
            <button @click="setActive(1)" :class="isActive(1) ? 'nav-link active' : 'nav-link'">Tab 2</button>
        </li>
    </ul>

    <div class="tab-content">
        <div x-show="isActive(0)" class="tab-pane">Content 1</div>
        <div x-show="isActive(1)" class="tab-pane">Content 2</div>
    </div>
</div>

<!-- Dropdown Component (uses balDropdown Alpine component) -->
<div x-data="balDropdown()">
    <button @click="toggle()" class="btn btn-secondary">
        Dropdown <i class="bi bi-chevron-down"></i>
    </button>
    <div x-show="open" @click.away="close()" class="dropdown-menu show">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
    </div>
</div>
```

### JavaScript Utilities

BAL Kit provides ready-to-use JavaScript utilities:

```javascript
// Toast notifications with Bootstrap styling
BalKit.toast('Success message!', 'success');
BalKit.toast('Error occurred!', 'error');
BalKit.toast('Warning message', 'warning');
BalKit.toast('Info message', 'info');

// Confirm dialogs using Bootstrap modals
const confirmed = await BalKit.confirm('Are you sure?', 'Delete Item');
if (confirmed) {
    // User clicked confirm
    console.log('User confirmed the action');
} else {
    // User clicked cancel
    console.log('User cancelled the action');
}
```

### Livewire Components

```php
// Example Livewire component using Bootstrap
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $message = '';

    public function submit()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);

        // Process form...

        session()->flash('success', 'Message sent successfully!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
```

## 🎛️ Configuration

The configuration file `config/bal-kit.php` allows customization of installation options:

```php
return [
    'install' => [
        'bootstrap' => true,
        'alpine' => true,
        'livewire' => true,
        'sass' => true,
        'auth' => false,
    ],

    'bootstrap' => [
        'version' => '^5.3',
        'include_icons' => true,
        'include_popper' => true,
    ],

    'alpine' => [
        'version' => '^3.14',
        'plugins' => [],
    ],

    'sass' => [
        'architecture' => '7-1',
        'directories' => [
            'abstracts', 'base', 'components',
            'layout', 'vendors'
        ],
    ],

    'paths' => [
        'sass' => 'resources/sass',
        'js' => 'resources/js',
        'views' => 'resources/views',
        'components' => 'app/Livewire',
    ],

    'presets' => [
        'minimal' => ['bootstrap' => true, 'alpine' => true],
        'standard' => ['bootstrap' => true, 'alpine' => true, 'livewire' => true, 'sass' => true],
        'full' => ['bootstrap' => true, 'alpine' => true, 'livewire' => true, 'sass' => true, 'auth' => true],
    ],
];
```

## 🏗️ File Structure

After installation, you'll have:

```
your-laravel-app/
├── resources/
│   ├── sass/                    # 7-1 SASS Architecture
│   │   ├── abstracts/          # Variables, mixins, functions
│   │   ├── base/               # Reset, typography, base styles
│   │   ├── components/         # Component-specific styles
│   │   ├── layout/             # Header, footer, sidebar, forms
│   │   ├── vendors/            # Bootstrap imports and customizations
│   │   └── app.scss            # Main SASS entry point
│   ├── js/
│   │   ├── app.js              # Main JavaScript entry point
│   │   └── bootstrap.js        # Bootstrap configuration
│   └── views/
│       └── layouts/
│           └── app.blade.php   # Main application layout
├── app/
│   └── Livewire/              # Organized Livewire components
│       ├── Components/
│       └── Pages/
└── config/
    └── bal-kit.php            # BAL Kit configuration
```

## 🔧 Customization

### SASS Customization

```scss
// resources/sass/abstracts/_variables.scss
$primary: #your-brand-color;
$text-font-stack: 'Your Font', system-ui, sans-serif;

// Override BAL Kit variables
$brand-color: rgb(229, 0, 80);
$max-width: 1200px;

// resources/sass/vendors/_bootstrap.scss
// Bootstrap is imported with BAL Kit customizations
@import "~bootstrap/scss/bootstrap";

// BAL Kit customizations are applied in .bal-kit wrapper
.bal-kit {
  // Your additional customizations here
}
```

### JavaScript Customization

```javascript
// resources/js/app.js
// Add your own Alpine.js components to the alpine:init event
document.addEventListener('alpine:init', () => {
    Alpine.data('yourComponent', () => ({
        // Your component logic
        message: 'Hello World',
        toggle() {
            this.message = this.message === 'Hello World' ? 'Goodbye World' : 'Hello World';
        }
    }));
});

// Extend BalKit utilities
BalKit.yourUtility = function(param) {
    // Your utility function
    console.log('Custom utility called with:', param);
};

// Available BalKit utilities:
// BalKit.toast(message, type) - Show Bootstrap toast notifications
// BalKit.confirm(message, title) - Show Bootstrap confirmation modal
```

## 🧪 Requirements

- **PHP**: 8.2 or higher
- **Laravel**: 10.0 or higher (supports Laravel 12)
- **Node.js**: 18.0 or higher
- **NPM**: 8.0 or higher

## 🔧 Troubleshooting

### Authentication Installation

BAL Kit provides **Bootstrap-styled authentication views** and **recommends Laravel Breeze** for complete authentication functionality.

**Default Behavior**: When you run `php artisan bal:install --preset=full` or `php artisan bal:install --auth`, BAL Kit will:

1. **Ask if you want Laravel Breeze** (recommended, default: **YES**)
   - **YES**: Installs complete authentication with Laravel Breeze + Bootstrap styling
   - **NO**: Installs only Bootstrap-styled authentication view templates (no controllers/logic)

**Complete Authentication (Recommended)**:

```bash
# Full preset with Breeze (recommended)
php artisan bal:install --preset=full
# Accept the prompt to install Laravel Breeze for complete authentication

# Or install Breeze first, then BAL Kit
composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan bal:install --preset=standard
```

**View Templates Only**:

```bash
# If you only want Bootstrap-styled authentication views
php artisan bal:install --auth
# Choose "No" when prompted for Laravel Breeze
# You'll need to implement your own controllers and routes
```

### SASS Compilation

BAL Kit uses modern SASS syntax that's compatible with Bootstrap. If you encounter compilation errors:

```bash
# Ensure all dependencies are installed
npm install

# Clear any cached builds
npm run build
```

### JavaScript Components Not Working

If Alpine.js components aren't working:

1. **Check if Alpine is loaded**: Open browser console and type `Alpine`
2. **Verify app.js is imported**: Check your main layout includes `@vite(['resources/js/app.js'])`
3. **Rebuild assets**: Run `npm run dev` or `npm run build`

### Common Issues

- **`npm run dev` fails**: Ensure you're in the Laravel project directory, not the package root
- **Missing Livewire commands**: BAL Kit v1.2.1+ automatically handles Livewire installation. If you encounter issues, run `composer require livewire/livewire` manually first
- **Permission errors**: Ensure proper directory permissions for `resources/` and `public/` directories
- **Components not found**: Make sure you've run `php artisan bal:install` with the appropriate preset
- **Livewire installation fails**: If you get "There are no commands defined in the 'livewire' namespace", this is fixed in v1.2.1+. For older versions, install Livewire manually first: `composer require livewire/livewire`

## 📄 License & Commercial Use

**BAL Kit is proprietary software** owned by Anthony Pagan. The source code is available for evaluation purposes only.

### Permitted Use

- ✅ View and examine source code for evaluation
- ✅ Personal, non-commercial testing and development
- ✅ Fork for contributing back to the original project

### Restricted Use

- ❌ Production use without commercial license
- ❌ Distribution or resale of the software
- ❌ Commercial derivative works

### Commercial Licensing

For production use, commercial projects, or any commercial application, please contact [get-tony@outlook.com](mailto:get-tony@outlook.com) for licensing information.

### Third-Party Components

BAL Kit incorporates MIT-licensed components (Laravel, Bootstrap, Alpine.js, Symfony Process) which remain under their respective licenses. See the [LICENSE](LICENSE) file for complete details.

## 🙏 Credits

- **Laravel Framework** - The PHP framework for web artisans
- **Bootstrap** - The world's most popular CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **Livewire** - Full-stack framework for Laravel

---

**Made with ❤️ by Anthony Pagan**

> The perfect alternative to TALL stack for Bootstrap lovers!

## 📚 Documentation

- **[Changelog](CHANGELOG.md)** - Version history and changes
- **[License](LICENSE)** - Usage rights and restrictions

## 🔗 Links

- **[Packagist](https://packagist.org/packages/get-tony/bal-kit)** - Package repository
- **[GitHub](https://github.com/get-tony/bal-kit)** - Source code
- **[Issues](https://github.com/get-tony/bal-kit/issues)** - Bug reports and feature requests
