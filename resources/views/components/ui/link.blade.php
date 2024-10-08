<a
    {{ $attributes->merge(['class' => 'text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5 h-10 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800 transition duration-300 inline-flex items-center']) }}>
    {{ $slot }}
</a>
