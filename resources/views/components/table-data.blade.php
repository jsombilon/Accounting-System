@props([
    'value',
    'icon' => null,
    'bordered' => false,
    'class' => 'px-4 py-2 text-center text-xs text-gray-700 dark:text-gray-300',
    'contentIcon' => null,
    'contentClass' => '',
])

@php
    $borderClasses = $bordered ? 'border border-gray-400 dark:border-gray-500' : '';
@endphp

<td {{ $attributes->except('class')->merge(['class' => $class]) }}>
    @if ($contentClass)
        {{-- Styled badge with icon --}}
        <span class="inline-flex items-center gap-1 {{ $contentClass }}">
            @if ($contentIcon)
                <x-icon :name="$contentIcon" class="w-3 h-3" />
            @elseif ($icon)
                <x-icon :name="$icon" class="w-3 h-3" />
            @endif
            {{ $value }}
        </span>
    @else
        {{-- Plain text (no badge styling) --}}
        @if ($icon)
            <span class="inline-flex items-center gap-1">
                <x-icon :name="$icon" class="w-3 h-3" />
                {{ $value }}
            </span>
        @else
            {{ $value }}
        @endif
    @endif
</td>
