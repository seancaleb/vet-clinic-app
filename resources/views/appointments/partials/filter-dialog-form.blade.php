<x-ui.alternative-button id="dialog-button" class="flex items-center gap-2 whitespace-nowrap justify-center"><svg
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
                    <x-ui.input-text id="name" name="name" type="text" placeholder="ex. John Doe" />
                </div>

                {{-- Filter by date range  --}}
                <div>
                    <x-ui.input-label :value="__('Filter by date range')" />
                    <x-ui.input-date-range-picker :wrapperId="__('datepicker-filter')" :datepickerStartId="__('datepicker-filter-start')" :datepickerEndId="__('datepicker-filter-end')" />
                </div>

                {{-- Filter by status  --}}
                <div>
                    <x-ui.input-label :value="__('Filter by status')" />
                    <div class="grid grid-cols-2 gap-4 sm:flex sm:items-center sm:gap-6">
                        <x-ui.input-radio :id="__('pending-filter')" :value="__('pending')" :name="__('status')" :labelFor="__('pending-filter')"
                            :labelValue="__('Pending')" />
                        <x-ui.input-radio :id="__('confirmed-filter')" :value="__('confirmed')" :name="__('status')" :labelFor="__('confirmed-filter')"
                            :labelValue="__('Confirmed')" />
                        <x-ui.input-radio :id="__('cancelled-filter')" :value="__('cancelled')" :name="__('status')" :labelFor="__('cancelled-filter')"
                            :labelValue="__('Cancelled')" />
                    </div>
                </div>
            </div>
        </form>
    </x-slot:content>

    <x-slot:footer>
        <div class="flex flex-col items-stretch sm:flex-row sm:items-center gap-2 justify-end">
            <x-ui.alternative-button id="filter-dialog-cancel-button">Cancel</x-ui.alternative-button>
            <x-ui.primary-button form="filter-appointment-form" id="filter-dialog-apply-button"
                class="order-first sm:order-none">Apply
                Filters</x-ui.primary-button>
        </div>
    </x-slot:footer>
</x-ui.dialog>
