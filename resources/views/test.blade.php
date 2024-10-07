<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Testing Playground') }}
        </h2>
    </x-slot>

    <section class="section max-w-xl mx-auto">
        <div class="grid gap-4 justify-items-start">
            <x-primary-button id="dialog-button">Trigger</x-primary-button>

            <x-ui.dialog :overlayId="__('filter-dialog-overlay')" :contentId="__('filter-dialog-content')">
                <x-slot:header>
                    <h4 class='font-semibold text-lg text-gray-900'>Filter options</h4>
                    <p class='text-sm text-gray-500'>Search by name, date, or status.</p>
                    <div class='absolute top-4 right-4'><svg xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x text-gray-500">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg></div>
                </x-slot:header>

                <x-slot:content>
                    <form action="" method="GET">
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
                        <x-ui.alternative-button>Cancel</x-ui.alternative-button>
                        <x-ui.primary-button>Apply Filters</x-ui.primary-button>
                    </div>
                </x-slot:footer>
            </x-ui.dialog>
        </div>
    </section>
</x-app-layout>
