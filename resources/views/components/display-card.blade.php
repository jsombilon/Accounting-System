@props([
    'title',
    'value' => null,
    'class' => 'bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-4',
])

<div {{ $attributes->merge(['class' => $class]) }}>
    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $title }}</h3>
    <div class="flex justify-end items-center mt-2">
        <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">{{ $value }}</p>
    </div>
</div>
