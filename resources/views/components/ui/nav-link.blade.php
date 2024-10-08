@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex h-10 items-center gap-3 text-gray-500 font-medium tracking-[-0.02em] text-[0.9375rem] px-4 py-2 rounded-lg bg-gray-50 text-gray-800'
            : 'flex h-10 items-center gap-3 text-gray-500 font-medium tracking-[-0.02em] text-[0.9375rem] px-4 py-2 rounded-lg';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
