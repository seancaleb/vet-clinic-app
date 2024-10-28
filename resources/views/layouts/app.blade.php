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
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/scripts.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="relative bg-gray-100 h-screen">
        @include('layouts.navigation')

        <div class="grid content-start fixed top-0 left-0 lg:left-[256px] right-0 bottom-0 z-10">
            <header>
                <div class="p-6 bg-white h-14 flex items-center justify-between border-b border-gray-300">
                    <div>
                        <div role=button class='lg:hidden' id="menu-burger-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M4 18q-.425 0-.712-.288T3 17t.288-.712T4 16h16q.425 0 .713.288T21 17t-.288.713T20 18zm0-5q-.425 0-.712-.288T3 12t.288-.712T4 11h16q.425 0 .713.288T21 12t-.288.713T20 13zm0-5q-.425 0-.712-.288T3 7t.288-.712T4 6h16q.425 0 .713.288T21 7t-.288.713T20 8z" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-gray-800 text-[0.9375rem] tracking-[-0.02em] leading-none">
                        {{ Auth::user()->name }} 👋🏻</span>
                </div>
                <div
                    class="p-6 bg-white sm:h-14 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between sm:gap-6 border-b border-gray-300">
                    <h2 class="font-semibold text-xl text-gray-800 leading-none tracking-[-0.015em]">
                        {{ $header }}
                    </h2>

                    {{ $actions ?? null }}
                </div>
            </header>

            {{-- Page Content  --}}
            <main class="sm:p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
