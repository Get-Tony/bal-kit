# Laravel BAL Kit

[![Latest Version on Packagist](https://img.shields.io/packagist/v/get-tony/bal-kit.svg?style=flat-square)](https://packagist.org/packages/get-tony/bal-kit)
[![License: Proprietary](https://img.shields.io/badge/License-Proprietary-red.svg)](https://github.com/get-tony/bal-kit/blob/main/LICENSE)
[![Laravel](https://img.shields.io/badge/Laravel-10%2B%20%7C%2012-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://php.net)

A modern Laravel starter kit that brings together **Bootstrap**, **Alpine.js**, and **Livewire** - the perfect alternative to TALL stack for developers who prefer Bootstrap over Tailwind CSS.

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

- **Professional layouts** - Application and authentication layouts
- **Flash message handling** - Bootstrap alert styling
- **Authentication scaffolding** - Bootstrap-styled auth forms
- **Organized structure** - Livewire components with clear organization

## 🛠️ Available Commands

```bash
# Installation and setup
php artisan bal:install [options]     # Install BAL Kit components
php artisan bal:publish [options]     # Publish resources

# NPM scripts (added to package.json)
npm run bal:dev                       # Start development server
npm run bal:build                     # Build for production
npm run bal:preview                   # Preview production build
```

## 🎨 Usage Examples

### Alpine.js Components

BAL Kit includes pre-built Alpine.js components that work seamlessly with Bootstrap:

```html
<!-- Modal Component -->
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

<!-- Tabs Component -->
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

<!-- Dropdown Component -->
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
// Toast notifications
BalKit.toast('Success message!', 'success');
BalKit.toast('Error occurred!', 'error');
BalKit.toast('Warning message', 'warning');
BalKit.toast('Info message', 'info');

// Confirm dialogs
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

    'sass' => [
        'architecture' => '7-1',
        'directories' => [
            'abstracts', 'base', 'components',
            'layout', 'pages', 'themes', 'vendors'
        ],
    ],

    'paths' => [
        'sass' => 'resources/sass',
        'js' => 'resources/js',
        'views' => 'resources/views',
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
│   │   ├── layout/             # Layout-related styles
│   │   ├── vendors/            # Bootstrap customizations
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
$font-family-sans-serif: 'Your Font', system-ui, sans-serif;

// Override Bootstrap variables before importing
$enable-rounded: false;
$enable-shadows: true;

// resources/sass/vendors/_bootstrap.scss
// Import Bootstrap with your customizations
@import 'abstracts/variables';
@import '~bootstrap/scss/bootstrap';
```

### JavaScript Customization

```javascript
// resources/js/app.js
// Add your own Alpine.js components
Alpine.data('yourComponent', () => ({
    // Your component logic
    message: 'Hello World',
    toggle() {
        this.message = this.message === 'Hello World' ? 'Goodbye World' : 'Hello World';
    }
}));

// Extend BalKit utilities
BalKit.yourUtility = function(param) {
    // Your utility function
    console.log('Custom utility called with:', param);
};
```

## 🧪 Requirements

- **PHP**: 8.2 or higher
- **Laravel**: 10.0 or higher (supports Laravel 12)
- **Node.js**: 18.0 or higher
- **NPM**: 8.0 or higher

## 🔧 Troubleshooting

### Authentication Installation Issues

If `php artisan bal:install --preset=full` fails with Breeze errors:

**Option 1**: Install Breeze manually first:

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan bal:install --preset=standard
```

**Option 2**: Use the standard preset and add auth manually:

```bash
php artisan bal:install --preset=standard
php artisan bal:install --auth
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
- **Missing Livewire commands**: Run `composer require livewire/livewire` if not automatically installed
- **Permission errors**: Ensure proper directory permissions for `resources/` and `public/` directories
- **Components not found**: Make sure you've run `php artisan bal:install` with the appropriate preset

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
- **[Release Notes](RELEASE_NOTES.md)** - Detailed information about this release
- **[Installation Guide](UPGRADE.md)** - Complete installation instructions
- **[License](LICENSE)** - Usage rights and restrictions

## 🔗 Links

- **[Packagist](https://packagist.org/packages/get-tony/bal-kit)** - Package repository
- **[GitHub](https://github.com/get-tony/bal-kit)** - Source code
- **[Issues](https://github.com/get-tony/bal-kit/issues)** - Bug reports and feature requests
