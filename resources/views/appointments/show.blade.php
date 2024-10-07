<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Appointment #{{ $appointment->id }}
        </h2>
    </x-slot>

    <section class='section max-w-xl mx-auto'>
        <div class='grid gap-1'>
            <div class='text-gray-900 text-lg font-medium'>Appointment for {{ $appointment->pet_name }}</div>
            <p>{{ $appointment->description }}</p>
            <div class='grid gap-1'>
                <div class="flex items-center gap-1">
                    <span>Type:</span>
                    <span>{{ $appointment->appointment_type }}</span>
                </div>

                <div class="flex items-center gap-1">
                    <span>Date:</span>
                    <span>{{ $appointment->appointment_date }}</span>
                </div>

                <div class="flex items-center gap-1">
                    <span>Status:</span>
                    <span>{{ $appointment->status }}</span>
                </div>
            </div>
        </div>

        <hr class='my-6'>

        <div class='flex justify-end'>
            <x-link href="{{ route('appointments.edit', ['appointment' => $appointment]) }}">Edit Appointment</x-link>
        </div>


    </section>
</x-app-layout>
