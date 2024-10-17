@php
    use Carbon\Carbon;

    $min_date = Carbon::now()->format('m/d/Y');

    $appointment_type_options = ['check-up', 'vaccination', 'surgery'];
@endphp

<x-app-layout>
    <x-slot:header>
        Create appointment
    </x-slot:header>

    <section class='section mx-auto max-w-2xl'>
        <header>
            <h2 class="text-lg font-medium text-gray-800">
                Book a new appointment
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Schedule now and make an appointment.
            </p>
        </header>


        <form method="POST" action="{{ route('appointments.index') }}" class="mt-6 space-y-6">
            @csrf

            <div>
                <x-ui.input-label for="description" :value="__('Description')" />
                <x-ui.input-text id="description" name="description" type="text" required />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-ui.input-label for="pet_name" :value="__('Pet name')" />
                <x-ui.input-text id="pet_name" name="pet_name" type="text" required />
                <x-input-error class="mt-2" :messages="$errors->get('pet_name')" />
            </div>

            <div>
                <x-input-label for="appointment_type" class="block mb-2 text-sm font-medium">Appointment
                    type</x-input-label>
                <x-ui.input-select :id="'appoinment_type'" :name="'appointment_type'" :defaultSelectedTitle="'Select an appointment'" :options="$appointment_type_options" />
                <x-input-error class="mt-2" :messages="$errors->get('appointment_type')" />
            </div>


            <div>
                <x-input-label for="appointment_date" :value="__('Date of appointment')" class="block mb-2 text-sm font-medium" />
                <x-ui.input-date-picker :id="'appointment_date'" :name="'appointment_date'" />
                <x-input-error class="mt-2" :messages="$errors->get('appointment_date')" />
            </div>

            <x-ui.primary-button class="w-full sm:w-fit">Create Appointment</x-ui.primary-button>
        </form>
    </section>
</x-app-layout>
