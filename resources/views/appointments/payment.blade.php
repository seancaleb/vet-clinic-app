@php
    use Carbon\Carbon;

    $formatted_date_schedule = Carbon::parse($appointment->appointment_date)->format('m/d/Y');
    $formatted_date_created = Carbon::parse($appointment->created_at)->format('F d, Y');
@endphp

<x-app-layout>
    <x-slot:header>
        Appointment #{{ $appointment->id }} Payment
    </x-slot:header>

    <x-slot:actions>
    </x-slot:actions>

    <section class='section mx-auto max-w-2xl'>
        <header>
            <h2 class="text-lg font-medium text-gray-800">
                Payment details
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Fill in your details for payment processing.
            </p>
        </header>


        <form method="POST" action="{{ route('appointments.processPayment', ['appointment' => $appointment]) }}"
            class="mt-6 space-y-6">
            @csrf

            <div>
                <x-ui.input-label for="name" :value="__('Name')" />
                <x-ui.input-text id='name' name="name" type="text" value="{{ $user->name }}"
                    :disabled="true" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-ui.input-label for="email" :value="__('Email')" />
                <x-ui.input-text id="email" name="email" type="text" required value="{{ $user->email }}"
                    :disabled="true" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div class="flex flex-col gap-6 sm:flex-row sm:gap-4 items-center">
                <div class="w-full">
                    <x-ui.input-label for="phone_number" :value="__('Phone')" />
                    <x-ui.input-text type="number" id="phone_number" name="phone_number" required placeholder="+639" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                </div>

                <div class="w-full">
                    <x-ui.input-label for="amount" :value="__('Amount')" />
                    <x-ui.input-text type="number" id="amount" name="amount" required />
                    <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                </div>
            </div>

            <x-ui.primary-button class="w-full sm:w-fit flex items-center gap-2 whitespace-nowrap justify-center"><svg
                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M3 20q-.825 0-1.412-.587T1 18V8q0-.425.288-.712T2 7t.713.288T3 8v10h16q.425 0 .713.288T20 19t-.288.713T19 20zm4-4q-.825 0-1.412-.587T5 14V6q0-.825.588-1.412T7 4h14q.825 0 1.413.588T23 6v8q0 .825-.587 1.413T21 16zm2-2q0-.825-.587-1.412T7 12v2zm10 0h2v-2q-.825 0-1.412.588T19 14m-5-1q1.25 0 2.125-.875T17 10t-.875-2.125T14 7t-2.125.875T11 10t.875 2.125T14 13M7 8q.825 0 1.413-.587T9 6H7zm14 0V6h-2q0 .825.588 1.413T21 8" />
                </svg>Pay Now</x-ui.primary-button>
        </form>
    </section>
</x-app-layout>
