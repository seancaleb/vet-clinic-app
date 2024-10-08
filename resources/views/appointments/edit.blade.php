@php
    use Carbon\Carbon;

    $min_date = Carbon::now()->format('m/d/Y');

    $appointment_type_options = ['check-up', 'vaccination', 'surgery'];
    $status_options = ['pending', 'confirmed', 'cancelled'];
@endphp

<x-app-layout>
    <x-slot:header>
        Manage appointment
    </x-slot:header>

    <section class='section mx-auto max-w-xl'>
        <header>
            <h2 class="text-lg font-medium text-gray-800">
                Manage appointment #{{ $appointment->id }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Modify appointment details.
            </p>
        </header>

        <form method="POST" action="{{ route('appointments.update', ['appointment' => $appointment]) }}"
            class="mt-6 space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-ui.input-text id="description" name="description" type="text" value="{{ $appointment->description }}"
                    required />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="pet_name" :value="__('Pet name')" />
                <x-ui.input-text id="pet_name" name="pet_name" type="text" value="{{ $appointment->pet_name }}"
                    required />
                <x-input-error class="mt-2" :messages="$errors->get('pet_name')" />
            </div>

            <div>
                <x-input-label for="appointment_type" class="block mb-2 text-sm font-medium">Appointment
                    type</x-input-label>
                <x-ui.input-select :id="'appoinment_type'" :name="'appointment_type'" :defaultSelectedTitle="'Select an appointment'" :options="$appointment_type_options"
                    :selected="$appointment->appointment_type" />
                <x-input-error class="mt-2" :messages="$errors->get('appointment_type')" />
            </div>

            @if ($user->role === 'admin')
                <div>
                    <x-input-label for="status" class="block mb-2 text-sm font-medium">Status</x-input-label>
                    <x-ui.input-select :id="'status'" :name="'status'" :defaultSelectedTitle="'Select status'" :options="$status_options"
                        :selected="$appointment->status" />
                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                </div>
            @endif

            <div>
                <x-input-label for="appointment_date" :value="__('Date of appointment')" class="block mb-2 text-sm font-medium" />
                <x-ui.input-date-picker :id="'appointment_date'" :name="'appointment_date'"
                    value="{{ Carbon::parse($appointment->appointment_date)->format('m/d/Y') }}" />
                <x-input-error class="mt-2" :messages="$errors->get('appointment_date')" />
            </div>


            <x-ui.primary-button class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h11.175q.4 0 .763.15t.637.425l2.85 2.85q.275.275.425.638t.15.762V19q0 .825-.587 1.413T19 21zM19 7.85L16.15 5H5v14h14zM12 18q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-5-8h7q.425 0 .713-.288T15 9V7q0-.425-.288-.712T14 6H7q-.425 0-.712.288T6 7v2q0 .425.288.713T7 10M5 7.85V19V5z" />
                </svg>Update Appointment</x-ui.primary-button>
        </form>
    </section>
</x-app-layout>
