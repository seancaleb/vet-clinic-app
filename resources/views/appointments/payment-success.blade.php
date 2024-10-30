<x-app-layout>
    <x-slot:header>
        Dashboard
    </x-slot:header>

    <section class="py-32 px-6 sm:px-8 w-full text-gray-500">
        <div class="grid gap-4 text-center w-full justify-items-center">
            <h2 class="font-bold text-5xl sm:text-6xl text-gray-800 leading-tight sm:leading-none tracking-[-0.025em]">
                Payment Successful
            </h2>

            <p class="text-lg max-w-[36ch]">Your payment for booking appointment {{ $appointment->id }} has been successful!</p>

            <x-ui.link href="{{ route('appointments.index') }}" class="flex items-center gap-2">
                Back to appointments</x-ui.link>
        </div>
    </section>
</x-app-layout>
