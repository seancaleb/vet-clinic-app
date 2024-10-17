<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center sm:pt-0 bg-gray-100">
        <div class="absolute top-8 left-12 hidden sm:block">
            <a href="/" class="w-full h-9 block">
                <x-application-logo />
            </a>
        </div>

        <div class="w-full sm:max-w-md overflow-hidden px-6 py-8 sm:p-8 bg-white sm:shadow sm:rounded-xl">
            <a href="/" class="w-full h-9 block sm:hidden mb-6">
                <x-application-logo />
            </a>

            <header class="mb-6">
                <h2 class="text-lg font-medium text-gray-800">
                    {{ $header }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $header_text }}
                </p>
            </header>

            {{ $slot }}


        </div>
    </div>
</body>

</html>
