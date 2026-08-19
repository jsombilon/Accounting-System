@props(['href', 'icon', 'label', 'active' => false])

@php
    $baseClasses = 'flex items-center gap-3 rounded-lg p-2.5 text-sm font-semibold transition-all duration-200';
    $stateClasses = $active
        ? 'bg-gray-200 dark:bg-gray-700 font-bold text-black dark:text-white'
        : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-black dark:text-white';
@endphp

<a href="{{ $href }}" @click="if (!sideBar) sideBar = true"
    {{ $attributes->merge(['class' => "$baseClasses $stateClasses"]) }} :class="sideBar ? '' : 'justify-center px-2.5'">
    <x-icon :name="$icon" class="h-5 w-5 shrink-0" />
    <span x-show="sideBar" class="whitespace-nowrap">{{ $label }}</span>
</a>
