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
            <section class='py-32 px-6 mx-auto max-w-lg relative'>
                <div class="grid gap-4 text-center bg-white p-6 justify-items-center">
                    <div class="p-1 bg-red-500/20 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-1w-14 text-red-500" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 17q.425 0 .713-.288T13 16t-.288-.712T12 15t-.712.288T11 16t.288.713T12 17m0-4q.425 0 .713-.288T13 12V8q0-.425-.288-.712T12 7t-.712.288T11 8v4q0 .425.288.713T12 13m0 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                        </svg>
                    </div>

                    <h2 class="font-semibold text-xl text-gray-800 leading-none tracking-[-0.015em]">
                        Page Not Found
                    </h2>

                    <span class="text-gray-500 max-w-[50ch]">{{ $error_message }}</span>


                    <x-ui.link href="{{ route('landing-page') }}" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="m10.8 12l3.9 3.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-4.6-4.6q-.15-.15-.212-.325T8.425 12t.063-.375t.212-.325l4.6-4.6q.275-.275.7-.275t.7.275t.275.7t-.275.7z" />
                        </svg>Back to home</x-ui.link>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
