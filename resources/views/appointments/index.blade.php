@php
    use Carbon\Carbon;

    // Need to check if exists to avoid error in testing
    if (!function_exists('format_date')) {
        function format_date($date)
        {
            return Carbon::parse($date)->format('m/d/Y');
        }
    }
@endphp

<x-app-layout>
    <x-slot:header>
        @if ($user->role === 'admin')
            {{ __('All Appointments') }}
        @else
            {{ __('My Appointments') }}
        @endif
    </x-slot:header>

    <x-slot:actions>
        <div class="flex items-center gap-2">
            <x-ui.link href="{{ route('appointments.create') }}" class="flex items-center gap-2"><svg
                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 21q-.425 0-.712-.288T11 20v-7H4q-.425 0-.712-.288T3 12t.288-.712T4 11h7V4q0-.425.288-.712T12 3t.713.288T13 4v7h7q.425 0 .713.288T21 12t-.288.713T20 13h-7v7q0 .425-.288.713T12 21" />
                </svg>
                New Appointment</x-ui.link>
            @if ($user->role === 'admin')
                <x-ui.alternative-button id="dialog-button" class="flex items-center gap-2"><svg
                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M11 18q-.425 0-.712-.288T10 17t.288-.712T11 16h2q.425 0 .713.288T14 17t-.288.713T13 18zm-4-5q-.425 0-.712-.288T6 12t.288-.712T7 11h10q.425 0 .713.288T18 12t-.288.713T17 13zM4 8q-.425 0-.712-.288T3 7t.288-.712T4 6h16q.425 0 .713.288T21 7t-.288.713T20 8z" />
                    </svg>
                    Filter By</x-ui.alternative-button>
                <x-ui.dialog :overlayId="__('filter-dialog-overlay')" :contentId="__('filter-dialog-content')" :closeBtnId="__('filter-dialog-close-button')">
                    <x-slot:header>
                        <h4 class='font-semibold text-lg text-gray-900'>Filter options</h4>
                        <p class='text-sm text-gray-500'>Search by name, date, or status.</p>
                    </x-slot:header>

                    <x-slot:content>
                        <form action="{{ route('appointments.index') }}" method="POST" id="filter-appointment-form">
                            @csrf
                            <div class="grid gap-6">
                                {{-- Filter by Search  --}}
                                <div>
                                    <x-ui.input-label :value="__('Filter by user')" />
                                    <x-ui.input-text id="name" name="name" type="text"
                                        placeholder="Enter name..." />
                                </div>

                                {{-- Filter by date range  --}}
                                <div>
                                    <x-ui.input-label :value="__('Filter by date range')" />
                                    <x-ui.input-date-range-picker :wrapperId="__('datepicker-filter')" :datepickerStartId="__('datepicker-filter-start')"
                                        :datepickerEndId="__('datepicker-filter-end')" />
                                </div>

                                {{-- Filter by status  --}}
                                <div>
                                    <x-ui.input-label :value="__('Filter by status')" />
                                    <div class="flex items-center gap-6">
                                        <x-ui.input-radio :id="__('pending-filter')" :value="__('pending')" :name="__('status')"
                                            :labelFor="__('pending-filter')" :labelValue="__('Pending')" />
                                        <x-ui.input-radio :id="__('confirmed-filter')" :value="__('confirmed')" :name="__('status')"
                                            :labelFor="__('confirmed-filter')" :labelValue="__('Confirmed')" />
                                        <x-ui.input-radio :id="__('cancelled-filter')" :value="__('cancelled')" :name="__('status')"
                                            :labelFor="__('cancelled-filter')" :labelValue="__('Cancelled')" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </x-slot:content>

                    <x-slot:footer>
                        <div class="flex items-center gap-2 justify-end">
                            <x-ui.alternative-button id="filter-dialog-cancel-button">Cancel</x-ui.alternative-button>
                            <x-ui.primary-button form="filter-appointment-form" id="filter-dialog-apply-button">Apply
                                Filters</x-ui.primary-button>
                        </div>
                    </x-slot:footer>
                </x-ui.dialog>
            @endif

        </div>
    </x-slot:actions>

    <section class="space-y-6">
        <div class="grid gap-6 justify-items-start">
            @if ($appointments->count() > 0)
                <table>
                    <tr>
                        <th class='whitespace-nowrap'>Pet name</th>
                        @if (Auth::user()->role === 'admin')
                            <th class='whitespace-nowrap'>Pet owner</th>
                        @endif
                        <th>Description</th>
                        <th>Type</th>
                        <th>Schedule</th>
                        <th>Status</th>
                    </tr>
                    @foreach ($appointments as $appointment)
                        <tr
                            onclick="window.location='{{ route('appointments.show', ['appointment' => $appointment]) }}'">
                            <td class='whitespace-nowrap text-gray-800 font-medium'>
                                {{ $appointment->pet_name }}</td>
                            @if (Auth::user()->role === 'admin')
                                <td class='text-gray-800 font-medium'>
                                    {{ $appointment->user->name }}</td>
                            @endif
                            <td class="min-w-[440px] break-words">{{ Str::words($appointment->description, 15) }}</td>
                            <td class='whitespace-nowrap'>
                                {{ ucfirst($appointment->appointment_type) }}
                            </td>
                            <td class='whitespace-nowrap'>
                                {{ format_date($appointment->appointment_date) }}</td>
                            <td class='whitespace-nowrap'>
                                <x-ui.badge-status
                                    :status="$appointment->status">{{ strtoupper($appointment->status) }}</x-ui.badge-status>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <section class="py-32 w-full text-gray-500">
                    <div class="grid gap-2 text-center w-full justify-items-center">
                        <h2 class="font-semibold text-xl text-gray-800 leading-none tracking-[-0.015em]">
                            No active appointments found.
                        </h2>
                        <p class="max-w-[50ch]">No appointments scheduled yet.</p>
                    </div>
                </section>
            @endif
        </div>

        <div>{{ $appointments->onEachSide(0)->links() }}</div>
    </section>
</x-app-layout>
