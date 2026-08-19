@props(['name', 'class' => 'w-5 h-5'])

@switch($name)
    @case('dashboard')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect width="7" height="9" x="3" y="3" rx="1" />
            <rect width="7" height="5" x="14" y="3" rx="1" />
            <rect width="7" height="9" x="14" y="12" rx="1" />
            <rect width="7" height="5" x="3" y="16" rx="1" />
        </svg>
    @break

    @case('search')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m21 21-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
        </svg>
    @break

    @case('chart')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 3v16a2 2 0 0 0 2 2h16" />
            <rect x="15" y="5" width="4" height="12" rx="1" />
            <rect x="7" y="8" width="4" height="9" rx="1" />
        </svg>
    @break

    @case('transactions')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m16 3 4 4-4 4" />
            <path d="M20 7H4" />
            <path d="m8 21-4-4 4-4" />
            <path d="M4 17h16" />
        </svg>
    @break

    @case('reports')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10 2v8l3-3 3 3V2" />
            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20" />
        </svg>
    @break

    @case('assets')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4" />
            <path d="M3 5v14a2 2 0 0 0 2 2h16v-5" />
            <path d="M18 12a2 2 0 0 0 0 4h4v-4Z" />
        </svg>
    @break

    @case('liability')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 3v18h18" />
            <path d="m19 9-5 5-4-4-3 3" />
        </svg>
    @break

    @case('plus')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 5v14M5 12h14" />
        </svg>
    @break

    @case('file-text')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <path d="M14 2v6h6" />
            <path d="M16 13H8" />
            <path d="M16 17H8" />
            <path d="M10 9H8" />
        </svg>
    @break

    @case('edit')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
        </svg>
    @break

    @case('report_btn')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 3v18h18" />
            <path d="m19 9-5 5-4-4-3 3" />
        </svg>
    @break

    @case('ghost')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-ghost-icon lucide-ghost">
            <path d="M9 10h.01" />
            <path d="M15 10h.01" />
            <path d="M12 2a8 8 0 0 0-8 8v12l3-3 2.5 2.5L12 19l2.5 2.5L17 19l3 3V10a8 8 0 0 0-8-8z" />
        </svg>
    @break

    @case('equity')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 6v6l4 2" />
        </svg>
    @break

    @case('income')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 15 6-6 6 6" />
        </svg>
    @break

    @case('expense')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 18H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5" />
            <path d="m16 19 3 3 3-3" />
            <path d="M18 12h.01" />
            <path d="M19 16v6" />
            <path d="M6 12h.01" />
            <circle cx="12" cy="12" r="2" />
        </svg>
    @break

    @case('all')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-gallery-vertical-end-icon lucide-gallery-vertical-end">
            <path d="M7 2h10" />
            <path d="M5 6h14" />
            <rect width="18" height="12" x="3" y="10" rx="2" />
        </svg>
    @break

    @case('journal entry')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-notebook-pen-icon lucide-notebook-pen">
            <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4" />
            <path d="M2 6h4" />
            <path d="M2 10h4" />
            <path d="M2 14h4" />
            <path d="M2 18h4" />
            <path
                d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
        </svg>
    @break

    @case('right arrow')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-chevrons-right-icon lucide-chevrons-right">
            <path d="m6 17 5-5-5-5" />
            <path d="m13 17 5-5-5-5" />
        </svg>
    @break

    @case('user')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 21a8 8 0 0 1 13.292-6" />
            <circle cx="10" cy="8" r="5" />
            <path d="m16 19 2 2 4-4" />
        </svg>
    @break

    @case('affiliate')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-handshake-icon lucide-handshake">
            <path d="m11 17 2 2a1 1 0 1 0 3-3" />
            <path
                d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4" />
            <path d="m21 3 1 11h-2" />
            <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3" />
            <path d="M3 4h8" />
        </svg>
    @break

    @case('chevron-down')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
        </svg>
    @break

    @case('check mark')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
        </svg>
    @break

    @case('peso')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 11H4" />
            <path d="M20 7H4" />
            <path d="M7 21V4a1 1 0 0 1 1-1h4a1 1 0 0 1 0 12H7" />
        </svg>
    @break

    {{-- mini tabs icon --}}
    @case('list')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-list-icon lucide-list">
            <path d="M3 5h.01" />
            <path d="M3 12h.01" />
            <path d="M3 19h.01" />
            <path d="M8 5h13" />
            <path d="M8 12h13" />
            <path d="M8 19h13" />
        </svg>
    @break

    @case('clock')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-clock-icon lucide-clock">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 6v6l4 2" />
        </svg>
    @break

    @case('thumbs_up')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-thumbs-up-icon lucide-thumbs-up">
            <path
                d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z" />
            <path d="M7 10v12" />
        </svg>
    @break

    @case('revision')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-clipboard-pen-icon lucide-clipboard-pen">
            <path d="M16 4h2a2 2 0 0 1 2 2v2" />
            <path
                d="M21.34 15.664a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
            <path d="M8 22H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
            <rect x="8" y="2" width="8" height="4" rx="1" />
        </svg>
    @break

    @case('cancelled')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-x-circle-icon lucide-x-circle">
            <circle cx="12" cy="12" r="10" />
            <path d="m15 9-6 6M9 9l6 6" />
        </svg>
    @break

    {{-- end mini tabs icon --}}
    @case('back')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-arrow-left-icon lucide-arrow-left">
            <path d="m12 19-7-7 7-7" />
            <path d="M19 12H5" />
        </svg>
    @break

    @case('dropdown-icon')
        <svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
        </svg>
    @break

    @case('trash')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-trash2-icon lucide-trash-2">
            <path d="M10 11v6" />
            <path d="M14 11v6" />
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
            <path d="M3 6h18" />
            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
        </svg>
    @break

    @case('view')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye">
            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
            <circle cx="12" cy="12" r="3" />
        </svg>
    @break

    @case('sidebar')
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-panel-right-open-icon lucide-panel-right-open">
            <rect width="18" height="18" x="3" y="3" rx="2" />
            <path d="M15 3v18" />
            <path d="m10 15-3-3 3-3" />
        </svg>
    @break

    @default
        <svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
        </svg>
@endswitch
