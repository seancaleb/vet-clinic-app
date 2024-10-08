<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a booking') }}
        </h2>
    </x-slot>

    <section class='section max-w-xl mx-auto'>
        <div class='grid gap-1'>
            <div class='text-gray-900 text-lg font-medium'>Book a new appointment</div>
            <p class='text-sm text-gray-500'>Lorem ipsum dolor sit amet consectetur harum
                sequi aliquid officiis.</p>
        </div>


        <form method="POST" action="{{ route('appointments.index') }}" class="mt-6 space-y-6">
            @csrf

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="pet_name" :value="__('Pet name')" />
                <x-text-input id="pet_name" name="pet_name" type="text" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('pet_name')" />
            </div>

            <div>
                <x-input-label for="appointment_type" class="block mb-2 text-sm font-medium">Appointment
                    type</x-input-label>
                <select id="appointment_type" name="appointment_type" required
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    <option selected disabled'>Select an appointment type</option>
                    <option value="check-up">Check-up</option>
                    <option value="vaccination">Vaccination</option>
                    <option value="surgery">Surgery</option>
                </select>
            </div>


            <div>
                <x-input-label for="appointment_date" :value="__('Date of appointment')" />
                <x-text-input id="appointment_date" name="appointment_date" type="date" class="mt-1 block w-full"
                    required min="{{ date('Y-m-d') }}" />
                <x-input-error class="mt-2" :messages="$errors->get('appointment_date')" />
            </div>



            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Create') }}</x-primary-button>
            </div>
        </form>
    </section>
</x-app-layout>
