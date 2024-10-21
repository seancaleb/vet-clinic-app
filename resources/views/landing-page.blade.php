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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/landing-page-scripts.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-white">
        {{-- Navbar  --}}
        <header class="bg-white h-20 sm:h-28 flex items-center w-full px-6 sm:px-8">
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

        <main>
            {{-- Header  --}}
            <section
                class="px-6 relative py-16 sm:pt-20 sm:pb-32 grid justify-items-center text-center mx-auto sm:max-w-3xl lg:max-w-4xl xl:max-w-6xl 2xl:max-w-7xl">
                <h1
                    class="font-heading font-semibold text-5xl sm:text-6xl leading-[1.15] sm:leading-[1.15] text-[#292929] tracking-[-0.05em] mb-4 sm:mb-6 max-w-[960px]">
                    Where pet care happens</h1>
                <p class="text-lg sm:text-xl text-gray-800 mb-6 sm:mb-8 max-w-[50ch]">Experience personalized pet care
                    at
                    VetHub which provides the highest quality care for
                    your pets.</p>
                <div>
                    <a href="{{ route('login') }}"
                        class="text-white bg-[#292929] hover:bg-opacity-90 font-medium rounded-lg px-10 py-[18px] focus:outline-none transition duration-300 w-fit leading-none inline-block">Try
                        It Now</a>
                </div>

                <div class='mt-12 sm:mt-16 max-w-[1060px] w-full relative z-10 rounded-3xl shadow-lg'>
                    <img src="/dashboard-img.webp" alt="dashboard image">
                </div>
            </section>

            {{-- About  --}}
            <section
                class='px-6 text-center mb-16 sm:mb-20 mx-auto sm:max-w-3xl lg:max-w-4xl xl:max-w-6xl 2xl:max-w-7xl'>
                <h2
                    class="font-heading font-semibold text-4xl sm:text-5xl tracking-[-0.025em] text-[#292929] mb-6 sm:mb-8">
                    Expert care for
                    your pet's health.
                </h2>

                <div class="flex flex-wrap sm:flex-nowrap items-center justify-center gap-x-12 gap-y-6">
                    <div class="flex gap-3 items-center">
                        <img src="/checkup.svg" alt="Check-up">
                        <span class="text-sm uppercase font-bold text-[#292929] tracking-[-0.025em]">Check-ups</span>
                    </div>

                    <div class="flex gap-3 items-center">
                        <img src="/vaccination.svg" alt="Check-up">
                        <span class="text-sm uppercase font-bold text-[#292929] tracking-[-0.025em]">Vaccination</span>
                    </div>

                    <div class="flex gap-3 items-center">
                        <img src="/surgery.svg" alt="Check-up">
                        <span class="text-sm uppercase font-bold text-[#292929] tracking-[-0.025em]">Surgery</span>
                    </div>
                </div>
            </section>

            {{-- Features  --}}
            <section class='px-6 relative mb-20 sm:mb-32 mx-auto sm:max-w-3xl lg:max-w-4xl xl:max-w-6xl 2xl:max-w-7xl'>
                <div class="grid sm:grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-6 auto-rows-fr">
                    <div class="p-6 sm:p-10 rounded-3xl border border-gray-200 bg-white">
                        <div class="mb-4">
                            <img src="/checkup.svg" alt="Check-up big" class='w-fit h-12'>
                        </div>

                        <h3
                            class="font-heading font-semibold text-2xl max-w-[20ch] tracking-[-0.025em] text-[#292929] mb-4">
                            Ensure your pet's happiness
                        </h3>
                        <p class="text-lg text-gray-800 max-w-[36ch]">Regular check-ups help catch health issues
                            early and keep your pet well.</p>

                    </div>

                    <div class="p-6 sm:p-10 rounded-3xl border border-gray-200 bg-white">
                        <div class="mb-4">
                            <img src="/vaccination.svg" alt="Check-up big" class='w-fit h-12'>
                        </div>

                        <h3
                            class="font-heading font-semibold text-2xl max-w-[20ch] tracking-[-0.025em] text-[#292929] mb-4">
                            Protect your pet with vaccines
                        </h3>
                        <p class="text-lg text-gray-800 max-w-[36ch]">Protect your pet from diseases with timely
                            vaccinations.</p>

                    </div>

                    <div class="p-6 sm:p-10 rounded-3xl border border-gray-200 bg-white">
                        <div class="mb-4">
                            <img src="/surgery.svg" alt="Check-up big" class='w-fit h-12'>
                        </div>

                        <h3
                            class="font-heading font-semibold text-2xl max-w-[20ch] tracking-[-0.025em] text-[#292929] mb-4">
                            Expert surgical care for your pet
                        </h3>
                        <p class="text-lg text-gray-800 max-w-[36ch]">Trust our expert team for safe,
                            high-quality surgical care.
                        </p>
                    </div>
                </div>
            </section>

            <section class='px-6 text-center mb-20 mx-auto sm:max-w-3xl lg:max-w-4xl xl:max-w-6xl 2xl:max-w-7xl'>
                <h2
                    class="font-heading font-semibold text-4xl sm:text-5xl tracking-[-0.025em] text-[#292929] mb-4 sm:mb-6">
                    Schedule an appointment now
                </h2>
                <p class="text-lg sm:text-xl text-gray-800 mb-6 sm:mb-8 max-w-[50ch] mx-auto">Schedule your pet’s visit
                    at a
                    time that works best for you, with easy online booking options.</p>
                <a href="{{ route('login') }}"
                    class="text-white bg-[#292929] hover:bg-opacity-90 font-medium rounded-lg px-10 py-[18px] focus:outline-none transition duration-300 w-fit leading-none inline-block">Get
                    Started</a>
            </section>
        </main>

        <footer class="bg-white h-40 sm:h-28 flex items-center w-full border-t border-gray-200 px-6 sm:px-8">
            <div class="max-w-7xl mx-auto w-full">
                <div class="flex flex-col justify-center sm:flex-row items-center sm:justify-between gap-4">
                    <a href="/" class="w-fit h-8 sm:h-9 inline-block">
                        <x-application-logo />
                    </a>
                    <span class="text-gray-500 text-sm text-center sm:text-left sm:whitespace-nowrap">Copyright © 2024
                        VetHub. All rights
                        reserved.</span>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
