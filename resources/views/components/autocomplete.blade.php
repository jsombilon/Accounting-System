@props([
    'name' => 'account',
    'placeholder' => 'Search account...',
    'options' => [], // Array of ['id' => 1, 'name' => 'Petty Cash']
    'maxResults' => 3, // Show 1-3 matches
    'required' => false,
    'nameExpression' => null,
])

<div x-data="{
    search: '',
    isOpen: false,
    selectedIndex: -1,
    options: @js($options),
    maxResults: {{ $maxResults }},

    get filtered() {
        if (this.search.length === 0) return [];

        const searchLower = this.search.toLowerCase();

        // Calculate match score for each option
        const scored = this.options
            .map(option => {
                const name = option.name.toLowerCase();
                let score = 0;

                // Exact match
                if (name === searchLower) score = 100;
                // Starts with search term
                else if (name.startsWith(searchLower)) score = 80;
                // Contains search term
                else if (name.includes(searchLower)) score = 60;
                // Word boundary match (each word starts with search)
                else if (name.split(' ').some(word => word.startsWith(searchLower))) score = 40;
                // Fuzzy match (any letter matches)
                else if (this.fuzzyMatch(searchLower, name)) score = 20;
                else return null;

                return { ...option, score };
            })
            .filter(item => item !== null)
            .sort((a, b) => b.score - a.score) // Highest score first
            .slice(0, this.maxResults); // Take top 3

        return scored;
    },

    fuzzyMatch(needle, haystack) {
        let needleIndex = 0;
        for (let i = 0; i < haystack.length; i++) {
            if (haystack[i] === needle[needleIndex]) {
                needleIndex++;
                if (needleIndex === needle.length) return true;
            }
        }
        return false;
    },

    selectOption(option) {
        this.search = option.name;
        this.isOpen = false;
        this.selectedIndex = -1;
    },

    onKeyDown(event) {
        if (!this.isOpen) return;

        if (event.key === 'ArrowDown') {
            event.preventDefault();
            this.selectedIndex = Math.min(this.selectedIndex + 1, this.filtered.length - 1);
        } else if (event.key === 'ArrowUp') {
            event.preventDefault();
            this.selectedIndex = Math.max(this.selectedIndex - 1, -1);
        } else if (event.key === 'Enter' && this.selectedIndex >= 0) {
            event.preventDefault();
            this.selectOption(this.filtered[this.selectedIndex]);
        } else if (event.key === 'Escape') {
            this.isOpen = false;
            this.selectedIndex = -1;
        }
    }
}" @click.outside="isOpen = false" class="relative w-full">
    {{-- Input field --}}
    <input type="text" @if ($nameExpression) x-bind:name="{{ $nameExpression }}" @else name="{{ $name }}" @endif
        x-model="search" @input="isOpen = true; selectedIndex = -1"
        @focus="isOpen = true" @keydown="onKeyDown($event)" placeholder="{{ $placeholder }}" autocomplete="off"
        {{ $required ? 'required' : '' }}
        class="text-sm w-full bg-white border border-gray-900 dark:bg-gray-900 text-black dark:text-white px-2 py-1 outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900">

    {{-- Suggestions dropdown --}}
    <div x-show="isOpen && filtered.length > 0" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto">
        <template x-for="(option, index) in filtered" :key="option.id">
            <button type="button" @click="selectOption(option)" @mouseenter="selectedIndex = index"
                :class="selectedIndex === index ?
                    'bg-blue-50 dark:bg-gray-700' :
                    'bg-white dark:bg-gray-800'"
                class="w-full text-left px-3 py-2 text-sm text-gray-900 dark:text-white hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors">
                <div class="flex items-center justify-between">
                    <span x-text="option.name"></span>
                    <span x-show="index === 0" class="text-xs text-blue-600 dark:text-blue-400 font-semibold">
                        Best match
                    </span>
                </div>
            </button>
        </template>
    </div>

    {{-- No results message --}}
    <div x-show="isOpen && search.length > 0 && filtered.length === 0"
        class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
        No accounts found
    </div>
</div>
