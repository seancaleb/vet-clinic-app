<button {!! $attributes->merge([
    'type' => 'submit',
    'class' =>
        'rounded-lg text-sm px-4 py-2.5 h-10 font-medium text-gray-800 focus:outline-none bg-white border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700',
]) !!}>{{ $slot }}</button>
