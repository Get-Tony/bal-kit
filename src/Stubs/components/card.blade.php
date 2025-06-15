@props([
    'title' => null,
    'subtitle' => null,
    'footer' => null,
    'variant' => 'default', // default, primary, success, warning, danger, info
    'shadow' => true,
    'headerClass' => '',
    'bodyClass' => '',
    'footerClass' => '',
    'bordered' => false,
    'flush' => false
])

@php
$cardClasses = collect([
    'card',
    $shadow ? 'shadow' : '',
    $bordered ? 'border' : '',
    $variant !== 'default' ? "border-{$variant}" : '',
])->filter()->implode(' ');

$headerClasses = collect([
    'card-header',
    $flush ? 'py-0' : 'py-3',
    $variant !== 'default' ? "bg-{$variant} text-white" : '',
    $headerClass
])->filter()->implode(' ');

$bodyClasses = collect([
    'card-body',
    $bodyClass
])->filter()->implode(' ');

$footerClasses = collect([
    'card-footer',
    $footerClass
])->filter()->implode(' ');
@endphp

<div {{ $attributes->merge(['class' => $cardClasses]) }}>
    @if($title || isset($header))
        <div class="{{ $headerClasses }}">
            @isset($header)
                {{ $header }}
            @else
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if($title)
                            <h6 class="m-0 font-weight-bold {{ $variant !== 'default' ? 'text-white' : 'text-primary' }}">
                                {{ $title }}
                            </h6>
                        @endif
                        @if($subtitle)
                            <small class="{{ $variant !== 'default' ? 'text-white-50' : 'text-muted' }}">
                                {{ $subtitle }}
                            </small>
                        @endif
                    </div>
                    @isset($actions)
                        <div>{{ $actions }}</div>
                    @endisset
                </div>
            @endisset
        </div>
    @endif

    <div class="{{ $bodyClasses }}">
        {{ $slot }}
    </div>

    @if($footer || isset($cardFooter))
        <div class="{{ $footerClasses }}">
            {{ $footer ?? $cardFooter }}
        </div>
    @endif
</div>
