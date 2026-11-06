@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-2.5 text-sm font-medium text-indigo-700 bg-indigo-50 rounded-lg group'
            : 'flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-lg group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>