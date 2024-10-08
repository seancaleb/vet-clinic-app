@props(['id', 'name', 'options', 'defaultSelectedTitle', 'selected' => false])

<select {!! $attributes->merge([
    'id' => $id,
    'name' => $name,
    'class' =>
        'h-[42px] bg-gray-50 border border-gray-300 text-gray-800 text-base rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full px-2.5 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500',
]) !!}>
    <option selected disabled>{{ $defaultSelectedTitle }}</option>
    @foreach ($options as $option)
        @if (!$selected)
            <option value="{{ $option }}">
                {{ ucfirst($option) }}
            @else
            <option value="{{ $option }}" @selected($selected === $option)>
                {{ ucfirst($option) }}
        @endif
        </option>
    @endforeach
</select>
