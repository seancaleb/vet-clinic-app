@props(['rows' => 8, 'value' => ''])

<textarea {!! $attributes->merge([
    'rows' => $rows,
    'class' =>
        'block p-2.5 w-full text-base text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 resize-none',
]) !!}>{{ $value }}</textarea>
