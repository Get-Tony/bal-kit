# Customization Guide

Learn how to customize and extend BAL Kit to match your project's needs.

## 🎨 SASS Customization

### 7-1 Architecture

BAL Kit uses the industry-standard 7-1 SASS architecture:

```
resources/sass/
├── abstracts/
│   ├── _variables.scss    # Custom variables
│   ├── _functions.scss    # Custom functions
│   └── _mixins.scss       # Custom mixins
├── base/
│   ├── _reset.scss        # Reset/normalize
│   ├── _typography.scss   # Typography rules
│   └── _base.scss         # Base styles
├── components/
│   ├── _buttons.scss      # Button styles
│   ├── _cards.scss        # Card styles
│   └── _forms.scss        # Form styles
├── layout/
│   ├── _header.scss       # Header styles
│   ├── _footer.scss       # Footer styles
│   └── _sidebar.scss      # Sidebar styles
├── pages/
│   ├── _home.scss         # Home page styles
│   └── _dashboard.scss    # Dashboard pages
├── themes/
│   └── _default.scss      # Default theme
├── vendors/
│   └── _bootstrap.scss    # Bootstrap overrides
└── app.scss               # Main SASS file
```

### Custom Variables

Override Bootstrap variables and add your own:

```scss
// resources/sass/abstracts/_variables.scss

// Brand Colors
$primary: #007bff;
$secondary: #6c757d;
$success: #28a745;
$info: #17a2b8;
$warning: #ffc107;
$danger: #dc3545;
$light: #f8f9fa;
$dark: #343a40;

// Custom Colors
$brand-blue: #1e3a8a;
$brand-green: #059669;
$brand-purple: #7c3aed;

// Typography
$font-family-sans-serif: 'Inter', system-ui, -apple-system, sans-serif;
$font-size-base: 1rem;
$line-height-base: 1.6;

// Spacing
$spacer: 1rem;
$spacers: (
  0: 0,
  1: $spacer * 0.25,
  2: $spacer * 0.5,
  3: $spacer,
  4: $spacer * 1.5,
  5: $spacer * 3,
  6: $spacer * 4,
  7: $spacer * 5,
);

// Border Radius
$border-radius: 0.5rem;
$border-radius-sm: 0.25rem;
$border-radius-lg: 0.75rem;

// Shadows
$box-shadow-sm: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
$box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
$box-shadow-lg: 0 1rem 3rem rgba(0, 0, 0, 0.175);
```

### Custom Mixins

Create reusable SASS mixins:

```scss
// resources/sass/abstracts/_mixins.scss

// Responsive breakpoints
@mixin respond-to($breakpoint) {
  @if $breakpoint == 'sm' {
    @media (min-width: 576px) { @content; }
  }
  @if $breakpoint == 'md' {
    @media (min-width: 768px) { @content; }
  }
  @if $breakpoint == 'lg' {
    @media (min-width: 992px) { @content; }
  }
  @if $breakpoint == 'xl' {
    @media (min-width: 1200px) { @content; }
  }
}

// Button variants
@mixin button-variant($background, $border, $hover-background: darken($background, 7.5%), $hover-border: darken($border, 10%)) {
  background-color: $background;
  border-color: $border;

  &:hover {
    background-color: $hover-background;
    border-color: $hover-border;
  }
}

// Card shadows
@mixin card-shadow($level: 1) {
  @if $level == 1 {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  } @else if $level == 2 {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
  } @else if $level == 3 {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
}

// Flexbox utilities
@mixin flex-center {
  display: flex;
  align-items: center;
  justify-content: center;
}

@mixin flex-between {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
```

### Component Customization

Customize individual components:

```scss
// resources/sass/components/_cards.scss

.card {
  @include card-shadow(1);
  border: none;
  border-radius: $border-radius-lg;

  &:hover {
    @include card-shadow(2);
    transform: translateY(-2px);
    transition: all 0.3s ease;
  }

  .card-header {
    background: linear-gradient(135deg, $primary, lighten($primary, 10%));
    color: white;
    border-radius: $border-radius-lg $border-radius-lg 0 0;

    .card-title {
      font-weight: 600;
      margin-bottom: 0;
    }
  }

  .card-body {
    padding: 1.5rem;
  }

  .card-footer {
    background-color: $light;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
  }
}

// Card variants
.card-primary {
  border-left: 4px solid $primary;
}

.card-success {
  border-left: 4px solid $success;
}

.card-warning {
  border-left: 4px solid $warning;
}

.card-danger {
  border-left: 4px solid $danger;
}
```

## 🧩 Component Customization

### Publishing Components

Publish components for customization:

```bash
php artisan bal:publish --components
```

This creates customizable component files in `resources/views/components/bal/`.

### Custom Button Component

Extend the button component:

```blade
{{-- resources/views/components/bal/button.blade.php --}}
@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'loading' => false,
    'icon' => null,
    'iconPosition' => 'left',
    'rounded' => false,
    'outline' => false,
    'gradient' => false,
])

@php
$classes = [
    'btn',
    $outline ? "btn-outline-{$variant}" : "btn-{$variant}",
    "btn-{$size}",
    $rounded ? 'rounded-pill' : '',
    $gradient ? 'btn-gradient' : '',
    $loading ? 'btn-loading' : '',
];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => implode(' ', array_filter($classes))]) }}
    @if($loading) disabled @endif
>
    @if($loading)
        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
    @elseif($icon && $iconPosition === 'left')
        <i class="bi bi-{{ $icon }} me-2"></i>
    @endif

    {{ $slot }}

    @if($icon && $iconPosition === 'right')
        <i class="bi bi-{{ $icon }} ms-2"></i>
    @endif
</button>
```

### Custom Card Component

Create an enhanced card component:

```blade
{{-- resources/views/components/bal/card.blade.php --}}
@props([
    'title' => null,
    'subtitle' => null,
    'variant' => null,
    'shadow' => true,
    'hover' => false,
    'collapsible' => false,
    'collapsed' => false,
])

@php
$classes = [
    'card',
    $variant ? "card-{$variant}" : '',
    $shadow ? 'shadow-sm' : '',
    $hover ? 'card-hover' : '',
];

$bodyId = $collapsible ? 'collapse-' . uniqid() : null;
@endphp

<div {{ $attributes->merge(['class' => implode(' ', array_filter($classes))]) }}>
    @if($title || isset($header))
        <div class="card-header @if($collapsible) cursor-pointer @endif"
             @if($collapsible)
                data-bs-toggle="collapse"
                data-bs-target="#{{ $bodyId }}"
                aria-expanded="{{ $collapsed ? 'false' : 'true' }}"
             @endif>
            @isset($header)
                {{ $header }}
            @else
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if($title)
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        @endif
                        @if($subtitle)
                            <small class="text-muted">{{ $subtitle }}</small>
                        @endif
                    </div>
                    @if($collapsible)
                        <i class="bi bi-chevron-down"></i>
                    @endif
                </div>
            @endisset
        </div>
    @endif

    <div class="card-body @if($collapsible) collapse @if(!$collapsed) show @endif @endif"
         @if($collapsible) id="{{ $bodyId }}" @endif>
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endisset
</div>
```

## 🎯 Layout Customization

### Custom App Layout

Create a custom application layout:

```blade
{{-- resources/views/layouts/custom-app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.25rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="p-3">
                    <h4 class="text-white mb-4">{{ config('app.name') }}</h4>

                    <nav class="nav flex-column">
                        <a class="nav-link text-white-50 active" href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door me-2"></i> Dashboard
                        </a>
                        <a class="nav-link text-white-50" href="#">
                            <i class="bi bi-people me-2"></i> Users
                        </a>
                        <a class="nav-link text-white-50" href="#">
                            <i class="bi bi-graph-up me-2"></i> Analytics
                        </a>
                        <a class="nav-link text-white-50" href="#">
                            <i class="bi bi-gear me-2"></i> Settings
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Top Navigation -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                    <div class="container-fluid">
                        @isset($header)
                            <div class="navbar-brand">{{ $header }}</div>
                        @endisset

                        <div class="navbar-nav ms-auto">
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <main class="p-4">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <!-- Toasts will be inserted here -->
    </div>
</body>
</html>
```

## 🔧 JavaScript Customization

### Custom BAL Kit JavaScript

Extend BAL Kit's JavaScript functionality:

```javascript
// resources/js/custom-bal-kit.js

// Extend the BalKit object
window.BalKit = window.BalKit || {};

// Custom toast function with more options
BalKit.customToast = function(message, type = 'info', options = {}) {
    const defaults = {
        duration: 4000,
        position: 'top-right',
        showProgress: true,
        closeButton: true,
        animation: 'slide'
    };

    const config = { ...defaults, ...options };

    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast toast-${type} toast-${config.position}`;
    toast.innerHTML = `
        <div class="toast-header">
            <i class="bi bi-${getIconForType(type)} me-2"></i>
            <strong class="me-auto">${capitalizeFirst(type)}</strong>
            ${config.closeButton ? '<button type="button" class="btn-close" data-bs-dismiss="toast"></button>' : ''}
        </div>
        <div class="toast-body">
            ${message}
            ${config.showProgress ? '<div class="toast-progress"></div>' : ''}
        </div>
    `;

    // Add to container and show
    const container = getToastContainer(config.position);
    container.appendChild(toast);

    const bsToast = new bootstrap.Toast(toast, {
        delay: config.duration
    });

    bsToast.show();

    // Auto remove after hiding
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
};

// Custom modal function
BalKit.customModal = function(title, content, options = {}) {
    const defaults = {
        size: 'md',
        backdrop: true,
        keyboard: true,
        buttons: [
            { text: 'Close', variant: 'secondary', dismiss: true }
        ]
    };

    const config = { ...defaults, ...options };

    const modalId = 'modal-' + Date.now();
    const modal = document.createElement('div');
    modal.className = 'modal fade';
    modal.id = modalId;
    modal.innerHTML = `
        <div class="modal-dialog modal-${config.size}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">${title}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    ${content}
                </div>
                <div class="modal-footer">
                    ${config.buttons.map(btn => `
                        <button type="button"
                                class="btn btn-${btn.variant}"
                                ${btn.dismiss ? 'data-bs-dismiss="modal"' : ''}
                                ${btn.onclick ? `onclick="${btn.onclick}"` : ''}>
                            ${btn.text}
                        </button>
                    `).join('')}
                </div>
            </div>
        </div>
    `;

    document.body.appendChild(modal);

    const bsModal = new bootstrap.Modal(modal, {
        backdrop: config.backdrop,
        keyboard: config.keyboard
    });

    bsModal.show();

    // Clean up after hiding
    modal.addEventListener('hidden.bs.modal', () => {
        modal.remove();
    });

    return bsModal;
};

// Utility functions
function getIconForType(type) {
    const icons = {
        success: 'check-circle',
        error: 'exclamation-circle',
        warning: 'exclamation-triangle',
        info: 'info-circle'
    };
    return icons[type] || 'info-circle';
}

function capitalizeFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function getToastContainer(position) {
    let container = document.querySelector(`.toast-container.${position}`);
    if (!container) {
        container = document.createElement('div');
        container.className = `toast-container position-fixed ${position} p-3`;
        document.body.appendChild(container);
    }
    return container;
}
```

## 🎨 Theme Customization

### Dark Theme

Create a dark theme variant:

```scss
// resources/sass/themes/_dark.scss

[data-theme="dark"] {
  // Background colors
  --bs-body-bg: #1a1a1a;
  --bs-body-color: #e9ecef;

  // Card colors
  --bs-card-bg: #2d2d2d;
  --bs-card-border-color: #404040;

  // Navigation
  --bs-navbar-bg: #2d2d2d;
  --bs-navbar-color: #e9ecef;

  // Forms
  --bs-form-control-bg: #404040;
  --bs-form-control-color: #e9ecef;
  --bs-form-control-border-color: #555;

  // Buttons
  .btn-primary {
    --bs-btn-bg: #0d6efd;
    --bs-btn-border-color: #0d6efd;
    --bs-btn-hover-bg: #0b5ed7;
    --bs-btn-hover-border-color: #0a58ca;
  }

  // Cards
  .card {
    background-color: var(--bs-card-bg);
    border-color: var(--bs-card-border-color);
    color: var(--bs-body-color);
  }

  // Modals
  .modal-content {
    background-color: var(--bs-card-bg);
    color: var(--bs-body-color);
  }
}

// Theme toggle button
.theme-toggle {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 1050;

  .btn {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
}
```

### Theme Toggle JavaScript

```javascript
// resources/js/theme-toggle.js

class ThemeToggle {
    constructor() {
        this.currentTheme = localStorage.getItem('theme') || 'light';
        this.init();
    }

    init() {
        this.applyTheme(this.currentTheme);
        this.createToggleButton();
        this.bindEvents();
    }

    applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        this.currentTheme = theme;
    }

    toggleTheme() {
        const newTheme = this.currentTheme === 'light' ? 'dark' : 'light';
        this.applyTheme(newTheme);
        this.updateToggleButton();
    }

    createToggleButton() {
        const button = document.createElement('div');
        button.className = 'theme-toggle';
        button.innerHTML = `
            <button class="btn btn-primary" id="theme-toggle-btn" title="Toggle theme">
                <i class="bi bi-${this.currentTheme === 'light' ? 'moon' : 'sun'}"></i>
            </button>
        `;
        document.body.appendChild(button);
    }

    updateToggleButton() {
        const icon = document.querySelector('#theme-toggle-btn i');
        if (icon) {
            icon.className = `bi bi-${this.currentTheme === 'light' ? 'moon' : 'sun'}`;
        }
    }

    bindEvents() {
        document.addEventListener('click', (e) => {
            if (e.target.closest('#theme-toggle-btn')) {
                this.toggleTheme();
            }
        });
    }
}

// Initialize theme toggle
document.addEventListener('DOMContentLoaded', () => {
    new ThemeToggle();
});
```

## 🔗 Related Documentation

- [Installation Guide](installation.md) - How to install BAL Kit
- [Configuration Guide](configuration.md) - Configure BAL Kit settings
- [Usage Examples](usage-examples.md) - Learn component usage
- [Troubleshooting](troubleshooting.md) - Common customization issues
