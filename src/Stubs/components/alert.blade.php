@props([
    'type' => 'info', // primary, secondary, success, danger, warning, info, light, dark
    'title' => null,
    'dismissible' => false,
    'icon' => null,
    'rounded' => true,
    'bordered' => false
])

@php
$classes = collect([
    'alert',
    "alert-{$type}",
    $dismissible ? 'alert-dismissible fade show' : '',
    $rounded ? '' : 'rounded-0',
    $bordered ? 'border' : ''
])->filter()->implode(' ');

$iconMap = [
    'primary' => 'fas fa-info-circle',
    'secondary' => 'fas fa-info-circle',
    'success' => 'fas fa-check-circle',
    'danger' => 'fas fa-exclamation-triangle',
    'warning' => 'fas fa-exclamation-triangle',
    'info' => 'fas fa-info-circle',
    'light' => 'fas fa-lightbulb',
    'dark' => 'fas fa-moon'
];

$defaultIcon = $iconMap[$type] ?? 'fas fa-info-circle';
$displayIcon = $icon ?? $defaultIcon;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} role="alert">
    @if($icon !== false)
        <i class="{{ $displayIcon }} me-2"></i>
    @endif

    @if($title)
        <h6 class="alert-heading mb-2">{{ $title }}</h6>
    @endif

    <div class="{{ $title ? 'mb-0' : '' }}">
        {{ $slot }}
    </div>

    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
