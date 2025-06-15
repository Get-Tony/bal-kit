# Usage Examples

Practical examples and code snippets for using BAL Kit components and features.

## 🎨 Component Examples

### Cards

Professional card components with various options:

```blade
{{-- Basic Card --}}
<x-bal-card title="Welcome" class="mb-4">
    <p>This is a basic card with a title and content.</p>
</x-bal-card>

{{-- Card with Header and Footer --}}
<x-bal-card>
    <x-slot name="header">
        <h5 class="card-title mb-0">Dashboard Stats</h5>
    </x-slot>

    <div class="row text-center">
        <div class="col-md-4">
            <h3 class="text-primary">1,234</h3>
            <p class="text-muted">Users</p>
        </div>
        <div class="col-md-4">
            <h3 class="text-success">5,678</h3>
            <p class="text-muted">Orders</p>
        </div>
        <div class="col-md-4">
            <h3 class="text-warning">$12,345</h3>
            <p class="text-muted">Revenue</p>
        </div>
    </div>

    <x-slot name="footer">
        <small class="text-muted">Last updated 3 mins ago</small>
    </x-slot>
</x-bal-card>
```

### Buttons

Various button styles and states:

```blade
{{-- Primary Actions --}}
<x-bal-button variant="primary" size="lg">
    Get Started
</x-bal-button>

{{-- With Icons --}}
<x-bal-button variant="success" icon="check">
    Save Changes
</x-bal-button>

{{-- Loading State --}}
<x-bal-button variant="primary" loading="true" id="submit-btn">
    Processing...
</x-bal-button>

{{-- Outline Buttons --}}
<x-bal-button variant="outline-secondary" size="sm">
    Cancel
</x-bal-button>
```

### Alerts

Contextual alert messages:

```blade
{{-- Success Alert --}}
<x-bal-alert type="success" dismissible="true">
    <strong>Success!</strong> Your changes have been saved.
</x-bal-alert>

{{-- Warning with Icon --}}
<x-bal-alert type="warning" icon="exclamation-triangle">
    <strong>Warning!</strong> This action cannot be undone.
</x-bal-alert>

{{-- Custom Alert --}}
<x-bal-alert type="info" class="border-0 bg-light">
    <h6 class="alert-heading">Did you know?</h6>
    <p class="mb-0">BAL Kit components are fully customizable.</p>
</x-bal-alert>
```

### Modals

Interactive modal dialogs:

```blade
{{-- Basic Modal --}}
<x-bal-modal id="example-modal" title="Confirm Action">
    <p>Are you sure you want to proceed with this action?</p>

    <x-slot name="footer">
        <x-bal-button variant="secondary" data-bs-dismiss="modal">
            Cancel
        </x-bal-button>
        <x-bal-button variant="primary">
            Confirm
        </x-bal-button>
    </x-slot>
</x-bal-modal>

{{-- Trigger Button --}}
<x-bal-button variant="primary" data-bs-toggle="modal" data-bs-target="#example-modal">
    Open Modal
</x-bal-button>
```

## 🏗️ Layout Examples

### App Layout

Complete application layout with navigation:

```blade
{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">Dashboard</h2>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                {{-- Sidebar --}}
                <x-bal-card class="mb-4">
                    <h6 class="card-title">Quick Actions</h6>
                    <div class="d-grid gap-2">
                        <x-bal-button variant="outline-primary" size="sm">
                            New Project
                        </x-bal-button>
                        <x-bal-button variant="outline-secondary" size="sm">
                            View Reports
                        </x-bal-button>
                    </div>
                </x-bal-card>
            </div>

            <div class="col-md-9">
                {{-- Main Content --}}
                <div class="row">
                    <div class="col-md-6">
                        <x-bal-card title="Recent Activity" class="mb-4">
                            <ul class="list-unstyled">
                                <li class="d-flex justify-content-between">
                                    <span>New user registered</span>
                                    <small class="text-muted">2 mins ago</small>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span>Order #1234 completed</span>
                                    <small class="text-muted">5 mins ago</small>
                                </li>
                            </ul>
                        </x-bal-card>
                    </div>

                    <div class="col-md-6">
                        <x-bal-card title="Statistics" class="mb-4">
                            <canvas id="stats-chart"></canvas>
                        </x-bal-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
```

### Guest Layout

Layout for authentication pages:

```blade
{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <x-bal-card>
                <x-slot name="header">
                    <h4 class="card-title text-center mb-0">Sign In</h4>
                </x-slot>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <div class="d-grid">
                        <x-bal-button type="submit" variant="primary">
                            Sign In
                        </x-bal-button>
                    </div>
                </form>

                <x-slot name="footer">
                    <div class="text-center">
                        <a href="{{ route('register') }}" class="text-decoration-none">
                            Don't have an account? Sign up
                        </a>
                    </div>
                </x-slot>
            </x-bal-card>
        </div>
    </div>
</x-guest-layout>
```

## ⚡ Livewire Integration

### Counter Component

Simple Livewire component with BAL Kit styling:

```php
<?php
// app/Livewire/Counter.php
namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
```

```blade
{{-- resources/views/livewire/counter.blade.php --}}
<x-bal-card title="Live Counter" class="text-center">
    <h2 class="display-4 text-primary">{{ $count }}</h2>

    <div class="d-flex justify-content-center gap-2 mt-3">
        <x-bal-button variant="outline-danger" wire:click="decrement">
            <i class="bi bi-dash"></i> Decrease
        </x-bal-button>

        <x-bal-button variant="outline-success" wire:click="increment">
            <i class="bi bi-plus"></i> Increase
        </x-bal-button>
    </div>
</x-bal-card>
```

### Todo List Component

More complex Livewire component:

```php
<?php
// app/Livewire/TodoList.php
namespace App\Livewire;

use Livewire\Component;

class TodoList extends Component
{
    public $todos = [];
    public $newTodo = '';

    public function addTodo()
    {
        if (trim($this->newTodo)) {
            $this->todos[] = [
                'id' => uniqid(),
                'text' => $this->newTodo,
                'completed' => false
            ];
            $this->newTodo = '';
        }
    }

    public function toggleTodo($id)
    {
        foreach ($this->todos as &$todo) {
            if ($todo['id'] === $id) {
                $todo['completed'] = !$todo['completed'];
                break;
            }
        }
    }

    public function removeTodo($id)
    {
        $this->todos = array_filter($this->todos, fn($todo) => $todo['id'] !== $id);
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}
```

```blade
{{-- resources/views/livewire/todo-list.blade.php --}}
<x-bal-card title="Todo List">
    <form wire:submit.prevent="addTodo" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Add new todo..."
                   wire:model="newTodo">
            <x-bal-button type="submit" variant="primary">
                Add
            </x-bal-button>
        </div>
    </form>

    @if(count($todos) > 0)
        <ul class="list-group">
            @foreach($todos as $todo)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               {{ $todo['completed'] ? 'checked' : '' }}
                               wire:click="toggleTodo('{{ $todo['id'] }}')">
                        <label class="form-check-label {{ $todo['completed'] ? 'text-decoration-line-through text-muted' : '' }}">
                            {{ $todo['text'] }}
                        </label>
                    </div>

                    <x-bal-button variant="outline-danger" size="sm"
                                  wire:click="removeTodo('{{ $todo['id'] }}')">
                        <i class="bi bi-trash"></i>
                    </x-bal-button>
                </li>
            @endforeach
        </ul>
    @else
        <div class="text-center text-muted py-4">
            <i class="bi bi-list-task display-4"></i>
            <p class="mt-2">No todos yet. Add one above!</p>
        </div>
    @endif
</x-bal-card>
```

## 🎨 Alpine.js Integration

### Interactive Components

Using Alpine.js with BAL Kit components:

```blade
{{-- Dropdown Menu --}}
<div x-data="{ open: false }" class="dropdown">
    <x-bal-button variant="primary" @click="open = !open">
        Menu <i class="bi bi-chevron-down"></i>
    </x-bal-button>

    <div x-show="open" @click.away="open = false"
         x-transition class="dropdown-menu show">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Something else</a>
    </div>
</div>

{{-- Tabs Component --}}
<div x-data="{ activeTab: 'tab1' }">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <button class="nav-link" :class="{ 'active': activeTab === 'tab1' }"
                    @click="activeTab = 'tab1'">
                Tab 1
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" :class="{ 'active': activeTab === 'tab2' }"
                    @click="activeTab = 'tab2'">
                Tab 2
            </button>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <div x-show="activeTab === 'tab1'" class="tab-pane">
            <x-bal-card>
                <h5>Tab 1 Content</h5>
                <p>This is the content for tab 1.</p>
            </x-bal-card>
        </div>

        <div x-show="activeTab === 'tab2'" class="tab-pane">
            <x-bal-card>
                <h5>Tab 2 Content</h5>
                <p>This is the content for tab 2.</p>
            </x-bal-card>
        </div>
    </div>
</div>
```

## 🚀 JavaScript Integration

### Toast Notifications

Using BAL Kit's JavaScript utilities:

```blade
<x-bal-button variant="success" onclick="BalKit.toast('Success!', 'success')">
    Show Success Toast
</x-bal-button>

<x-bal-button variant="danger" onclick="BalKit.toast('Error occurred!', 'error')">
    Show Error Toast
</x-bal-button>

<x-bal-button variant="info" onclick="BalKit.toast('Information', 'info', 5000)">
    Show Info Toast (5s)
</x-bal-button>
```

### Form Validation

Enhanced form validation with BAL Kit:

```blade
<form id="contact-form" novalidate>
    <div class="mb-3">
        <label for="name" class="form-label">Name *</label>
        <input type="text" class="form-control" id="name" required>
        <div class="invalid-feedback">Please provide a valid name.</div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email *</label>
        <input type="email" class="form-control" id="email" required>
        <div class="invalid-feedback">Please provide a valid email.</div>
    </div>

    <x-bal-button type="submit" variant="primary">
        Submit Form
    </x-bal-button>
</form>

<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();

    if (this.checkValidity()) {
        BalKit.toast('Form submitted successfully!', 'success');
        // Handle form submission
    } else {
        this.classList.add('was-validated');
        BalKit.toast('Please fix the errors below', 'error');
    }
});
</script>
```

## 🔗 Related Documentation

- [Installation Guide](installation.md) - How to install BAL Kit
- [Configuration Guide](configuration.md) - Customize BAL Kit settings
- [Customization Guide](customization.md) - Modify and extend components
- [Troubleshooting](troubleshooting.md) - Common usage issues
