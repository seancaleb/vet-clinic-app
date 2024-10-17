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
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <x-ui.link href="{{ route('appointments.create') }}"
                class="flex items-center gap-2 whitespace-nowrap justify-center"><svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 21q-.425 0-.712-.288T11 20v-7H4q-.425 0-.712-.288T3 12t.288-.712T4 11h7V4q0-.425.288-.712T12 3t.713.288T13 4v7h7q.425 0 .713.288T21 12t-.288.713T20 13h-7v7q0 .425-.288.713T12 21" />
                </svg>
                New Appointment</x-ui.link>
            @if ($user->role === 'admin')
                @include('appointments.partials.filter-dialog-form')
            @endif
        </div>
    </x-slot:actions>

    <section class="space-y-6 p-6 sm:p-0">
        <div class="grid gap-6 justify-items-start overflow-x-auto rounded-xl">
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
                                <td class='text-gray-800 font-medium whitespace-nowrap'>
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
                            No active appointments.
                        </h2>
                        <p class="max-w-[50ch]">No scheduled appointments were found.</p>
                    </div>
                </section>
            @endif
        </div>

        <div>{{ $appointments->onEachSide(0)->links() }}</div>
    </section>
</x-app-layout>
