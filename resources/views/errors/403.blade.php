@php
    $error_message = $exception->getMessage();
@endphp

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
    <div class="relative bg-white h-screen">
        <main>
            <section class="py-32 w-full text-gray-500">
                <div class="grid gap-4 text-center w-full justify-items-center">
                    <h2 class="font-bold text-6xl text-gray-800 leading-none tracking-[-0.025em]">
                        Forbidden
                    </h2>

                    <p class="text-lg max-w-[36ch]">{{ $error_message }}</p>

                    <x-ui.link href="{{ route('landing-page') }}" class="flex items-center gap-2">
                        Back to home</x-ui.link>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
