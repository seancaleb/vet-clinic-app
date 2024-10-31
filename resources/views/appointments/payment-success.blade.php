@php
    use Carbon\Carbon;

    $date = $appointment->payment->created_at;
    $formattedDate = Carbon::parse($date)->format('F j, Y');
@endphp

<x-app-layout>
    <x-slot:header>
        Dashboard
    </x-slot:header>

    <section class='section mx-auto max-w-lg relative'>
        <div class="grid gap-4 text-center bg-white p-6 justify-items-center">
            <div class="p-1 bg-green-500/20 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-1w-14 text-green-500" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m10.6 13.8l-2.15-2.15q-.275-.275-.7-.275t-.7.275t-.275.7t.275.7L9.9 15.9q.3.3.7.3t.7-.3l5.65-5.65q.275-.275.275-.7t-.275-.7t-.7-.275t-.7.275zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                </svg>
            </div>

            <h2 class="font-semibold text-xl text-gray-800 leading-none tracking-[-0.015em]">
                Payment Successful
            </h2>

            <span class="text-2xl text-gray-800 font-semibold">₱{{ number_format($appointment->payment->amount) }}</span>

            <div class="grid gap-1 mb-2">
                <span class="text-gray-800 font-medium">You have successfully paid your appointment.</span>
                <span class="text-sm text-gray-500">Payed at {{ $formattedDate }}</span>
            </div>

            <x-ui.link href="{{ route('appointments.index') }}" class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m10.8 12l3.9 3.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-4.6-4.6q-.15-.15-.212-.325T8.425 12t.063-.375t.212-.325l4.6-4.6q.275-.275.7-.275t.7.275t.275.7t-.275.7z" />
                </svg>
                Back to appointments</x-ui.link>
        </div>
    </section>
</x-app-layout>
