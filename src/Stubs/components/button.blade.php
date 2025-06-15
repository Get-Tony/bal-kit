@props([
    'variant' => 'primary', // primary, secondary, success, danger, warning, info, light, dark, link
    'size' => 'md', // sm, md, lg
    'outline' => false,
    'block' => false,
    'disabled' => false,
    'loading' => false,
    'loadingText' => 'Loading...',
    'icon' => null,
    'iconPosition' => 'left', // left, right, only
    'href' => null,
    'target' => null,
    'confirm' => null,
    'tooltip' => null
])

@php
$tag = $href ? 'a' : 'button';

$classes = collect([
    'btn',
    $outline ? "btn-outline-{$variant}" : "btn-{$variant}",
    $size === 'sm' ? 'btn-sm' : '',
    $size === 'lg' ? 'btn-lg' : '',
    $block ? 'd-grid' : '',
    $disabled || $loading ? 'disabled' : ''
])->filter()->implode(' ');

$attributes = $attributes->merge([
    'class' => $classes,
    'disabled' => $disabled || $loading,
]);

if ($href) {
    $attributes = $attributes->merge([
        'href' => $href,
        'target' => $target,
        'role' => 'button'
    ]);
} else {
    $attributes = $attributes->merge([
        'type' => $attributes->get('type', 'button')
    ]);
}

if ($confirm) {
    $attributes = $attributes->merge([
        'onclick' => "return confirm('{$confirm}')"
    ]);
}

if ($tooltip) {
    $attributes = $attributes->merge([
        'data-bs-toggle' => 'tooltip',
        'title' => $tooltip
    ]);
}
@endphp

<{{ $tag }} {{ $attributes }}>
    @if($loading)
        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
        {{ $loadingText }}
    @else
        @if($icon && ($iconPosition === 'left' || $iconPosition === 'only'))
            <i class="{{ $icon }} {{ $iconPosition === 'only' ? '' : 'me-2' }}"></i>
        @endif

        @if($iconPosition !== 'only')
            {{ $slot }}
        @endif

        @if($icon && $iconPosition === 'right')
            <i class="{{ $icon }} ms-2"></i>
        @endif
    @endif
</{{ $tag }}>
