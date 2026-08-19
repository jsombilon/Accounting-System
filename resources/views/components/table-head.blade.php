@props([
    'value',
    'bordered' => false, // New prop: borders on/off
    'class' => 'px-4 py-2 text-center text-xs font-medium text-gray-700 dark:text-gray-400 tracking-wider',
    'contentClass' => '',
])

@php
    $borderClasses = $bordered ? 'border border-gray-400 dark:border-gray-500' : '';
@endphp

<th {{ $attributes->merge(['class' => "{$class} {$borderClasses} {$contentClass}"]) }}>
    {{ $value }}
</th>
