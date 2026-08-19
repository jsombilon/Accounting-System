@props([
    'href' => null,
])
@if ($href)
    <a href="{{ $href }}"
        {{ $attributes->except('href')->merge([
            'class' =>
                'inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800',
        ]) }}>
        {{ $slot }}
    </a>
@else
    <button type="button"
        {{ $attributes->merge([
            'class' =>
                'inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800',
        ]) }}>
        {{ $slot }}
    </button>
@endif
