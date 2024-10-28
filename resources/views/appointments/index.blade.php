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
        </div>
    </x-slot:actions>

    <section class="space-y-6 p-6 sm:p-0">
        <div class="grid gap-6 justify-items-start rounded-xl">
            @if ($appointments->count() > 0)
                {{-- Display a table of appointments  --}}
                <table id="appointments-table">
                    <thead>
                        <tr>
                            <th class='whitespace-nowrap'>Pet name</th>
                            @if (Auth::user()->role === 'admin')
                                <th class='whitespace-nowrap'>Pet owner</th>
                            @endif
                            <th>Description</th>
                            <th>Type</th>
                            <th>Schedule</th>
                            <th>Status</th>
                            <th class='whitespace-nowrap'>Payment status</th>
                        </tr>
                    </thead>
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
    </section>
</x-app-layout>

<script type='text/javascript'>
    const userRole = "{{ Auth::user()->role }}";

    $(document).ready(function() {
        let columns = [{
                data: 'pet_name',
                name: 'pet_name'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'appointment_type',
                name: 'appointment_type'
            },
            {
                data: 'appointment_date',
                name: 'appointment_date'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'payment_status',
                name: 'payment_status'
            }
        ];

        if (userRole === 'admin') {
            columns.splice(1, 0, {
                data: 'pet_owner',
                name: 'user.name'
            });
        }

        $('#appointments-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('appointments.index') }}",
            columns,
            "rowCallback": function(row, data, dataIndex) {
                let appointmentId = data.id;
                let url = `/appointments/${appointmentId}`;

                $(row).attr('onclick', `location.href='${url}'`);
                $(row).addClass('cursor-pointer');
            },
            createdRow: function(row, data, dataIndex) {
                if (userRole === 'admin') {
                    $('td:eq(0)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                    $('td:eq(1)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                    $('td:eq(2)', row).addClass('min-w-[328px] break-words w-full');
                    $('td:eq(3)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                    $('td:eq(4)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                    $('td:eq(5)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                    $('td:eq(6)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                } else {
                    $('td:eq(0)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                    $('td:eq(1)', row).addClass('min-w-[328px] break-words w-full');
                    $('td:eq(2)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                    $('td:eq(3)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                    $('td:eq(4)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                    $('td:eq(5)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                }
            },
        })
    })
</script>
