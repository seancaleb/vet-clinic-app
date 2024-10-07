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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/scripts.js'])
</head>

<body class="font-sans antialiased">
    <div class="relative bg-gray-100 h-screen">
        @include('layouts.navigation')

        <div class="grid content-start fixed top-0 left-[256px] right-0 bottom-0 z-10">
            <header>
                <div class="p-6 bg-white h-14 flex items-center justify-end border-b border-gray-300">
                    <span class="text-gray-500 text-[0.9375rem] leading-none">Hi,
                        {{ Auth::user()->name }}</span>
                </div>
                <div class="p-6 bg-white h-14 flex items-center border-b border-gray-300">
                    <h2 class="font-semibold text-xl text-gray-800 leading-none">
                        {{ $header }}
                    </h2>
                </div>
            </header>

            {{-- Page Content  --}}
            <main class="p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>



        {{-- <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            {{ $slot }}
        </main> --}}
    </div>
</body>

</html>
