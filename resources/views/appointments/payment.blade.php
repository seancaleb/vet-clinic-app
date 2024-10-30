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


        <form method="POST" action="{{ route('appointments.processPayment', ['appointment' => $appointment]) }}" class="mt-6 space-y-6">
            @csrf

            <div>
                <x-ui.input-label for="name" :value="__('Name')" />
                <x-ui.input-text id='name' name="name" type="text" value="{{ $user->name }}" :disabled="true" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-ui.input-label for="email" :value="__('Email')" />
                <x-ui.input-text id="email" name="email" type="text" required value="{{ $user->email }}" :disabled="true" />
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

            <x-ui.primary-button class="w-full sm:w-fit">Pay Now</x-ui.primary-button>
        </form>
    </section>
</x-app-layout>
