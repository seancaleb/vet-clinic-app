@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center gap-3 text-gray-500 font-medium text-sm px-4 py-2 rounded-lg bg-gray-100 text-gray-800'
            : 'flex items-center gap-3 text-gray-500 font-medium text-sm px-4 py-2 rounded-lg';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
