@props(['active'])

@php
$classes = $active
            ? 'px-3 py-2 rounded-md bg-blue-600 text-white font-medium'
            : 'px-3 py-2 rounded-md text-gray-600 hover:bg-blue-50 hover:text-blue-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
