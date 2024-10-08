<x-app-layout>
    <x-slot:header>
        Dashboard
    </x-slot:header>

    <section class="py-32 w-full text-gray-500">
        <div class="grid gap-4 text-center w-full justify-items-center">
            <h2 class="font-bold text-6xl text-gray-800 leading-none tracking-[-0.025em]">
                Welcome to VetHub
            </h2>

            <p class="text-lg max-w-[36ch]">Schedule appointments and experience personalized care for your pets.</p>

            <x-ui.link href="{{ route('appointments.create') }}" class="flex items-center gap-2"><svg
                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 21q-.425 0-.712-.288T11 20v-7H4q-.425 0-.712-.288T3 12t.288-.712T4 11h7V4q0-.425.288-.712T12 3t.713.288T13 4v7h7q.425 0 .713.288T21 12t-.288.713T20 13h-7v7q0 .425-.288.713T12 21" />
                </svg>
                New Appointment</x-ui.link>
        </div>
    </section>
</x-app-layout>
