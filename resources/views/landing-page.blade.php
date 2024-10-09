<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VetHub - Veterinary Clinic</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-white">
        <header class="bg-white h-[70px] flex items-center w-full px-5 sm:px-6 border-b border-gray-300">
            <div class="max-w-7xl mx-auto w-full">
                <div class="flex items-center justify-between gap-4">
                    <a href="/" class="w-full h-8 sm:h-9 block">
                        <x-application-logo />
                    </a>
                    <nav>
                        <ul class="flex items-center gap-4 sm:gap-8">
                            <li><a href="{{ route('login') }}"
                                    class="text-gray-500 hover:text-gray-800 transition duration-150 text-[0.9375rem] font-medium">Login</a>
                            </li>
                            <li><a href="{{ route('register') }}"
                                    class="text-gray-500 hover:text-gray-800 transition duration-150 text-[0.9375rem] font-medium">Register</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <main class="py-32 px-5 sm:px-6">
            <section class="grid justify-items-center text-center">
                <h1 class="font-bold text-[56px] sm:text-[80px] text-gray-800 leading-none tracking-[-0.025em] mb-6">Pet
                    Care Hub</h1>
                <p class="text-lg sm:text-xl text-gray-500 mb-6 max-w-[50ch]">Experience personalized pet care at
                    VetHub which the highest quality care for
                    your pets.</p>
                <a href="{{ route('login') }}"
                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg px-6 py-3 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800 transition duration-300 w-fit">Get
                    Started</a>
            </section>
        </main>
    </div>
</body>

</html>
