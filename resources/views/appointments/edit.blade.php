<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Appointment') }}
        </h2>
    </x-slot>

    <section class='section max-w-xl mx-auto'>
        <div class='grid gap-1'>
            <div class='text-gray-900 text-lg font-medium'>Edit Appointment #{{ $appointment->id }}</div>
            <p class='text-sm text-gray-500'>Lorem ipsum dolor sit amet consectetur harum
                sequi aliquid officiis.</p>
        </div>


        <form method="POST" action="{{ route('appointments.update', ['appointment' => $appointment]) }}"
            class="mt-6 space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required
                    value="{{ $appointment->description }}" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="pet_name" :value="__('Pet name')" />
                <x-text-input id="pet_name" name="pet_name" type="text" class="mt-1 block w-full" required
                    value="{{ $appointment->pet_name }}" />
                <x-input-error class="mt-2" :messages="$errors->get('pet_name')" />
            </div>

            <div>
                <x-input-label for="appointment_type" class="block mb-2 text-sm font-medium">Appointment
                    type</x-input-label>
                <select id="appointment_type" name="appointment_type" required value=""
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    <option disabled>Select an appointment type</option>
                    <option value="check-up" @selected($appointment->appointment_type === 'check-up')>Check-up</option>
                    <option value="vaccination" @selected($appointment->appointment_type === 'vaccination')>Vaccination</option>
                    <option value="surgery" @selected($appointment->appointment_type === 'surgery')>Surgery</option>
                </select>
            </div>

            @if ($user->role === 'admin')
                <div>
                    <x-input-label for="status" class="block mb-2 text-sm font-medium">Status</x-input-label>
                    <select id="status" name="status" required value=""
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <option disabled>Select status</option>
                        <option value="pending" @selected($appointment->status === 'pending')>Pending</option>
                        <option value="confirmed" @selected($appointment->status === 'confirmed')>Confirmed</option>
                        <option value="cancelled" @selected($appointment->status === 'cancelled')>Cancelled</option>
                    </select>
                </div>
            @endif


            <div>
                <x-input-label for="appointment_date" :value="__('Date of appointment')" />
                <x-text-input id="appointment_date" name="appointment_date" type="date"
                    value="{{ $appointment->appointment_date }}" class="mt-1 block w-full" required
                    min="{{ date('Y-m-d') }}" />
                <x-input-error class="mt-2" :messages="$errors->get('appointment_date')" />
            </div>



            <div class="flex items-center gap-4 justify-between">
                <x-primary-button form="delete-appointment-form"
                    class='bg-transparent text-red-700 hover:bg-red-50 focus:bg-red-50 active:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500'>{{ __('Cancel Appointment') }}</x-primary-button>
                <x-primary-button>{{ __('Update Appointment') }}</x-primary-button>
            </div>
        </form>

        <form action="{{ route('appointments.destroy', ['appointment' => $appointment]) }}" method="POST"
            class='hidden' id="delete-appointment-form">
            @csrf
            @method('DELETE')
        </form>
    </section>
</x-app-layout>
