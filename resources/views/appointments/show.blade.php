@php
    use Carbon\Carbon;

    $formatted_date_schedule = Carbon::parse($appointment->appointment_date)->format('m/d/Y');
    $formatted_date_created = Carbon::parse($appointment->created_at)->format('F d, Y');
@endphp

<x-app-layout>
    <x-slot:header>
        Appointment #{{ $appointment->id }}
    </x-slot:header>

    <x-slot:actions>
        @if ($appointment->status === 'cancelled' || Auth::user()->role === 'admin')
            <x-ui.primary-button form="delete-appointment-form"
                class="bg-red-700 hover:bg-red-800 focus:ring-red-300 border border-red-800/20 flex items-center gap-2 whitespace-nowrap justify-center"><svg
                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
                </svg>Delete Appointment</x-ui.primary-button>
        @else
            @if (Auth::user()->role === 'patient')
                <div class="flex items-center gap-2">
                    @if ($appointment->payment_status !== 'paid')
                        <x-ui.link href="{{ route('appointments.payment', ['appointment' => $appointment]) }}"
                            class="flex items-center gap-2 w-full sm:w-fit"><svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-white" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M3 20q-.825 0-1.412-.587T1 18V8q0-.425.288-.712T2 7t.713.288T3 8v10h16q.425 0 .713.288T20 19t-.288.713T19 20zm4-4q-.825 0-1.412-.587T5 14V6q0-.825.588-1.412T7 4h14q.825 0 1.413.588T23 6v8q0 .825-.587 1.413T21 16zm2-2q0-.825-.587-1.412T7 12v2zm10 0h2v-2q-.825 0-1.412.588T19 14m-5-1q1.25 0 2.125-.875T17 10t-.875-2.125T14 7t-2.125.875T11 10t.875 2.125T14 13M7 8q.825 0 1.413-.587T9 6H7zm14 0V6h-2q0 .825.588 1.413T21 8" />
                            </svg>
                            Pay
                        </x-ui.link>
                        <x-ui.primary-button id="cancel-appointment-button" data-appointment-id="{{ $appointment->id }}"
                            class="bg-red-700 hover:bg-red-800 focus:ring-red-300 border border-red-800/20 flex items-center gap-2 whitespace-nowrap justify-center">Cancel
                            Appointment
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M16.15 13H5q-.425 0-.712-.288T4 12t.288-.712T5 11h11.15L13.3 8.15q-.3-.3-.288-.7t.288-.7q.3-.3.713-.312t.712.287L19.3 11.3q.15.15.213.325t.062.375t-.062.375t-.213.325l-4.575 4.575q-.3.3-.712.288t-.713-.313q-.275-.3-.288-.7t.288-.7z" />
                            </svg>
                        </x-ui.primary-button>
                    @endif
                </div>
            @endif
        @endif

        {{-- Temporary Solution for AJAX to replace Cancel Requirement Button when 'status' is changed to 'cancelled' --}}
        <x-ui.primary-button id="delete-appointment-button" form="delete-appointment-form"
            class="bg-red-700 hover:bg-red-800 focus:ring-red-300 border border-red-800/20 hidden items-center gap-2 whitespace-nowrap justify-center"><svg
                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
            </svg>Delete Appointment</x-ui.primary-button>
    </x-slot:actions>


    <section class='section mx-auto max-w-2xl relative'>
        <div class='space-y-6 text-gray-800'>
            <div class="space-y-[10px]">
                <h2 class="font-semibold text-xl text-gray-800 leading-none tracking-[-0.015em]">
                    Appointment for {{ $appointment->pet_name }}
                </h2>

                @if ($appointment->status === 'pending')
                    <x-ui.badge-status data-badge-status-text="badge-status-text" :status="$appointment->status"
                        class="flex items-center gap-1.5 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-600" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V3q0-.425.288-.712T7 2t.713.288T8 3v1h8V3q0-.425.288-.712T17 2t.713.288T18 3v1h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
                        </svg>
                        Waiting for approval
                    </x-ui.badge-status>
                @elseif ($appointment->status === 'confirmed')
                    <x-ui.badge-status data-badge-status-text="badge-status-text" :status="$appointment->status"
                        class="flex items-center gap-1.5 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V3q0-.425.288-.712T7 2t.713.288T8 3v1h8V3q0-.425.288-.712T17 2t.713.288T18 3v1h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
                        </svg>
                        Scheduled at {{ $formatted_date_schedule }}
                    </x-ui.badge-status>
                @else
                    <x-ui.badge-status data-badge-status-text="badge-status-text" :status="$appointment->status"
                        class="flex items-center gap-1.5 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-600" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V3q0-.425.288-.712T7 2t.713.288T8 3v1h8V3q0-.425.288-.712T17 2t.713.288T18 3v1h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
                        </svg>
                        Appointment is cancelled
                    </x-ui.badge-status>
                @endif
            </div>


            <div class="grid gap-4 grid-cols-2">
                <div class="col-span-1 space-y-1">
                    <div class="text-sm text-gray-500">Pet name</div>
                    <div>{{ $appointment->pet_name }}</div>
                </div>

                <div class="col-span-1 space-y-1">
                    <div class="text-sm text-gray-500">Status</div>
                    <x-ui.badge-status data-badge-status="badge-status"
                        :status="$appointment->status">{{ strtoupper($appointment->status) }}</x-ui.badge-status>
                </div>
            </div>

            <div class="grid gap-4 grid-cols-2">
                <div class="col-span-1 space-y-1">
                    <div class="text-sm text-gray-500">Appointment type</div>
                    <div>{{ ucfirst($appointment->appointment_type) }}</div>
                </div>
                <div class="col-span-1 space-y-1">
                    <div class="text-sm text-gray-500">Payment status</div>
                    <x-ui.badge-status data-badge-status="badge-status"
                        :status="$appointment->payment_status">{{ strtoupper($appointment->payment_status) }}</x-ui.badge-status>
                </div>
            </div>

            <div class="col-span-1 space-y-1">
                <div class="text-sm text-gray-500">Description</div>
                <div class="whitespace-pre-wrap">{{ $appointment->description }}</div>
            </div>
        </div>

        @if ($appointment->status === 'pending' || Auth::user()->role === 'admin')
            <div class='mt-6' id="edit-appointment-button-wrapper">
                <x-ui.link href="{{ route('appointments.edit', ['appointment' => $appointment]) }}"
                    class="flex items-center gap-2 w-full sm:w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M14 21v-1.65q0-.2.075-.387t.225-.338l5.225-5.2q.225-.225.5-.325t.55-.1q.3 0 .575.113t.5.337l.925.925q.2.225.313.5t.112.55t-.1.563t-.325.512l-5.2 5.2q-.15.15-.337.225T16.65 22H15q-.425 0-.712-.287T14 21m7.5-5.575l-.925-.925zm-6 5.075h.95l3.025-3.05l-.925-.925l-3.05 3.025zM6 22q-.825 0-1.412-.587T4 20V4q0-.825.588-1.412T6 2h7.175q.4 0 .763.15t.637.425l4.85 4.85q.275.275.425.638t.15.762v1.425q0 .425-.288.713T19 11.25t-.712-.288T18 10.25V9h-4q-.425 0-.712-.288T13 8V4H6v16h5q.425 0 .713.288T12 21t-.288.713T11 22zm0-2V4zm13.025-3.025l-.475-.45l.925.925z" />
                    </svg>Edit Appointment
                </x-ui.link>
            </div>
        @endif
    </section>

    <form action="{{ route('appointments.destroy', ['appointment' => $appointment]) }}" method="POST" class='hidden'
        id="delete-appointment-form">
        @csrf
        @method('DELETE')
    </form>
</x-app-layout>
