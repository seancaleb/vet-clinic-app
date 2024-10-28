<x-app-layout>
    <x-slot:header>{{ __('All Users') }}</x-slot:header>

    <section class="space-y-6 p-6 sm:p-0">
        <div class="grid gap-6 justify-items-start rounded-xl">
            @if ($users->count() > 1)
                <table id="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="whitespace-nowrap">No. of appointments</th>
                            <th class="whitespace-nowrap">Created at</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            @else
                <section class="py-32 w-full text-gray-500">
                    <div class="grid gap-2 text-center w-full justify-items-center">
                        <h2 class="font-semibold text-xl text-gray-800 leading-none tracking-[-0.015em]">
                            No active users at the moment.
                        </h2>
                        <p class="max-w-[50ch]">There are currently no active patients yet.</p>
                    </div>
                </section>
            @endif
        </div>
    </section>
</x-app-layout>

<script type='text/javascript'>
    $(document).ready(function() {
        let columns = [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'role',
                name: 'role'
            },
            {
                data: 'number_of_appointments',
                name: 'number_of_appointments'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'status',
                name: 'status'
            }
        ];

        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columnDefs: [{
                orderable: false,
                targets: [3, 5]
            }],
            columns,
            "rowCallback": function(row, data, dataIndex) {
                let userId = data.id;
                let url = `/users/${userId}`;

                $(row).attr('onclick', `location.href='${url}'`);
                $(row).addClass('cursor-pointer');
            },
            createdRow: function(row, data, dataIndex) {
                $('td:eq(0)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                $('td:eq(1)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                $('td:eq(2)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                $('td:eq(3)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                $('td:eq(4)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
                $('td:eq(5)', row).addClass('max-w-[228px] min-w-[128px] whitespace-nowrap');
            },
        })
    })
</script>
