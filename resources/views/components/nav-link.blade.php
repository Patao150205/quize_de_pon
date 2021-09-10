@props(['active'])

@php
$classes = $active ?? false ? 'block px-1 py-2 border-b-4 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' : 'block px-1 py-2 border-b-4 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-red-200 focus:outline-none focus:text-gray-700 focus:border-red-200 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
