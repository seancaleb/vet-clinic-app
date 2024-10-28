@props(['status'])

@php
    switch ($status) {
        case 'pending':
            $class =
                'text-xs font-semibold rounded-full px-[10px] py-0.5 bg-yellow-500/10 text-yellow-500 inline-block';
            break;
        case 'confirmed':
        case 'verified':
        case 'paid':
            $class = 'text-xs font-semibold rounded-full px-[10px] py-0.5 bg-green-500/10 text-green-500 inline-block';
            break;
        case 'cancelled':
        case 'not-verified':
        case 'unpaid':
            $class = 'text-xs font-semibold rounded-full px-[10px] py-0.5 bg-red-500/10 text-red-500 inline-block';
            break;
        default:
            $class = 'text-xs font-semibold rounded-full px-[10px] py-0.5 bg-gray-500/10 text-gray-500 inline-block';
            break;
    }
@endphp

<div {!! $attributes->merge(['class' => $class]) !!}>
    {{ $slot }}</div>
