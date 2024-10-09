@props(['id', 'value', 'name', 'labelFor', 'labelValue'])

<div class="flex items-center">
    <input {!! $attributes->merge([
        'id' => $id,
        'type' => 'radio',
        'value' => $value,
        'name' => $name,
        'class' =>
            'w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 focus:ring-gray-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
    ]) !!}>
    <label {!! $attributes->merge([
        'for' => $labelFor,
        'class' => 'ms-2 text-sm font-medium text-gray-900 dark:text-gray-300',
    ]) !!}>{{ $labelValue ?? $slot }}</label>
</div>
