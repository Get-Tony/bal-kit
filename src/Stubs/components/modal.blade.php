@props([
    'id' => 'modal',
    'title' => null,
    'size' => 'md', // sm, md, lg, xl
    'centered' => false,
    'scrollable' => false,
    'backdrop' => 'true', // true, false, static
    'keyboard' => 'true',
    'fullscreen' => false,
    'headerClass' => '',
    'bodyClass' => '',
    'footerClass' => '',
    'closeButton' => true
])

@php
$modalClasses = collect([
    'modal',
    'fade'
])->filter()->implode(' ');

$dialogClasses = collect([
    'modal-dialog',
    $size === 'sm' ? 'modal-sm' : '',
    $size === 'lg' ? 'modal-lg' : '',
    $size === 'xl' ? 'modal-xl' : '',
    $centered ? 'modal-dialog-centered' : '',
    $scrollable ? 'modal-dialog-scrollable' : '',
    $fullscreen === true ? 'modal-fullscreen' : '',
    is_string($fullscreen) ? "modal-fullscreen-{$fullscreen}-down" : ''
])->filter()->implode(' ');

$headerClasses = collect([
    'modal-header',
    $headerClass
])->filter()->implode(' ');

$bodyClasses = collect([
    'modal-body',
    $bodyClass
])->filter()->implode(' ');

$footerClasses = collect([
    'modal-footer',
    $footerClass
])->filter()->implode(' ');
@endphp

<div class="{{ $modalClasses }}" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true"
     data-bs-backdrop="{{ $backdrop }}" data-bs-keyboard="{{ $keyboard }}">
    <div class="{{ $dialogClasses }}">
        <div class="modal-content">
            @if($title || isset($header) || $closeButton)
                <div class="{{ $headerClasses }}">
                    @isset($header)
                        {{ $header }}
                    @else
                        @if($title)
                            <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                        @endif
                        @if($closeButton)
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        @endif
                    @endisset
                </div>
            @endif

            <div class="{{ $bodyClasses }}">
                {{ $slot }}
            </div>

            @isset($footer)
                <div class="{{ $footerClasses }}">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>
