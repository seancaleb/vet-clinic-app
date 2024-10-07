<button {!! $attributes->merge([
    'type' => 'submit',
    'class' =>
        'text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-[0.9375rem] px-5 py-2 h-[42px] dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800 transition duration-300',
]) !!}>{{ $slot }}</button>
