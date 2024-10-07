<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if ($user->role === 'admin')
                {{ __('All Appointments') }}
            @else
                {{ __('My Appointments') }}
            @endif
        </h2>
    </x-slot>

    <section class="space-y-6">
        <div class="grid gap-6 justify-items-start">
            @if ($user->role !== 'admin')
                <x-link href="{{ route('appointments.create') }}">Create new booking</x-link>
            @else
                @isset($queryParams)
                    @foreach ($queryParams as $param)
                        <div>{{ $param }}</div>
                    @endforeach
                @endisset

                <x-ui.primary-button id="dialog-button">Trigger</x-ui.primary-button>

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
                                    <x-ui.input-date-picker :wrapperId="__('datepicker-filter')" :datepickerStartId="__('datepicker-filter-start')" :datepickerEndId="__('datepicker-filter-end')" />
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


            @if ($appointments->count() > 0)
                <table class="bg-white rounded-xl overflow-clip">
                    <tr>
                        <th class='whitespace-nowrap'>Pet name</th>
                        @if (Auth::user()->role === 'admin')
                            <th class='whitespace-nowrap'>Pet Owner</th>
                        @endif
                        <th>Description</th>
                        <th>Type</th>
                        <th>Date</th>
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
                                {{ $appointment->appointment_date }}</td>
                            <td class='whitespace-nowrap'>
                                <x-ui.badge-status
                                    :status="$appointment->status">{{ strtoupper($appointment->status) }}</x-ui.badge-status>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <div class='px-6 py-8 rounded-lg bg-indigo-50/50 text-center'>
                    <p>There are no active appointment/s listed at the moment.</p>
                </div>

            @endif
        </div>

        <div>{{ $appointments->onEachSide(0)->links() }}</div>
    </section>
</x-app-layout>
