@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        "bg-gray-50 border border-gray-300 text-gray-800 text-base rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full px-2.5 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 " . ($disabled ? 'cursor-not-allowed' : ''),
]) !!} />
