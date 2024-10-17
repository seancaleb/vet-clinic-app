@php
    use Carbon\Carbon;

    $min_date = Carbon::now()->addDay()->format('m/d/Y');
@endphp

@props(['id', 'datepickerOrientation' => 'top right', 'name', 'minDate' => $min_date])

<div class="relative max-w-sm">
    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V3q0-.425.288-.712T7 2t.713.288T8 3v1h8V3q0-.425.288-.712T17 2t.713.288T18 3v1h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
        </svg>
    </div>
    <input datepicker datepicker-autohide required {!! $attributes->merge([
        'id' => $id,
        'type' => 'text',
        'datepicker-orientation' => $datepickerOrientation,
        'name' => $name,
        'datepicker-min-date' => $minDate,
        'placeholder' => 'Select date',
        'class' =>
            'h-[42px] bg-gray-50 border border-gray-300 text-gray-800 text-base rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full ps-10 px-2.5 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500',
    ]) !!}>
</div>
