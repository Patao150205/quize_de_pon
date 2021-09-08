@php
$classes = 'rounded-full w-10 h-10';
@endphp

<img {{ $attributes->merge(['class' => $classes]) }} src="{{ asset('/favicon.ico') }}" />
