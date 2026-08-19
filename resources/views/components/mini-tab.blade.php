@props(['value' => '', 'icon' => ''])

<button type="button" @click="activeTab = '{{ $value }}'"
    x-bind:class="activeTab === '{{ $value }}'
        ?
        'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-semibold ring-1 ring-blue-200 dark:ring-blue-800' :
        'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white'"
    class="flex items-center justify-between px-4 py-1 text-xs rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
    @if ($icon)
        <x-icon name="{{ $icon }}" class="w-4 h-4 mr-2" />
    @endif
    {{ $slot }}
</button>
