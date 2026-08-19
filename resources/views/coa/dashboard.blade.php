<x-app-layout>

    @section('title', 'Chart of Accounts')

    <x-slot name="header">
        Chart of Accounts Dashboard
    </x-slot>

    <x-slot name="buttonAction">
        $dispatch('open-modal-new-account')
    </x-slot>

    <x-slot name="buttonLabel">
        New Account
    </x-slot>


    <div class="p-6 text-gray-900 dark:text-gray-100">
        {{-- Pass accounts data to Alpine.js --}}
        <div x-data="chartOfAccounts({{ $accountsJson }})">

            {{-- ============================================ --}}
            {{-- FILTER CONTROLS                             --}}
            {{-- ============================================ --}}
            <div class="flex flex-wrap items-center gap-3 mb-4">

                {{-- Type Tabs --}}
                <div class="flex flex-wrap gap-1 p-1 bg-gray-100 dark:bg-gray-900/50 rounded-xl">
                    <button @click="selectTab('all')"
                        :class="selectedTab === 'all'
                            ?
                            'bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm' :
                            'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white'"
                        class="px-3 py-1.5 text-sm font-semibold rounded-lg transition-all">
                        All Accounts
                    </button>
                    @foreach ($accountsTable as $account)
                        @if ($account->depth === 1)
                            <button @click="selectTab({{ $account->id }})"
                                :class="selectedTab === {{ $account->id }} ?
                                    'bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm' :
                                    'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white'"
                                class="px-3 py-1.5 text-sm font-semibold rounded-lg transition-all">
                                {{ $account->name }}
                            </button>
                        @endif
                    @endforeach
                </div>

                {{-- Level Filter --}}
                <div class="flex items-center gap-2">
                    <label for="level-filter"
                        class="text-sm font-medium text-gray-600 dark:text-gray-400 whitespace-nowrap">
                        Filter by Level:
                    </label>
                    <select id="level-filter" x-model="selectedLevel"
                        class="px-3 py-1.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all">All Levels</option>
                        <option value="top">Top Level</option>
                        <option value="level1">Level 1</option>
                        <option value="level2">Level 2</option>
                        <option value="level3">Level 3</option>
                        <option value="level4">Level 4</option>
                    </select>
                </div>

                {{-- Search Bar --}}
                <div class="flex-1 min-w-[200px] max-w-md">
                    <div class="relative">
                        <input type="text" x-model="searchTerm" @input="searchTerm = $event.target.value"
                            placeholder="Search filtered accounts..."
                            class="w-full pl-10 pr-3 py-1.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400 dark:placeholder-gray-500">
                        <x-icon name="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                    </div>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- ACCOUNT COUNT                               --}}
            {{-- ============================================ --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 mb-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Showing
                    <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredAccounts.length"></span>
                    of
                    <span class="font-semibold text-gray-900 dark:text-white" x-text="allAccounts.length"></span>
                    accounts
                </p>
            </div>

            {{-- ============================================ --}}
            {{-- ACCOUNTS TABLE                               --}}
            {{-- ============================================ --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">

                <template x-if="allAccounts.length === 0">
                    {{-- Empty State --}}
                    <div class="p-12 text-center">
                        <x-icon name="ghost" class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" />
                        <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">No accounts yet</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Start by creating your first account.
                        </p>
                        <x-primary-button @click="$dispatch('open-modal-new-account')">
                            <x-icon name="plus" class="w-4 h-4" />
                            Create First Account
                        </x-primary-button>
                    </div>
                </template>

                <template x-if="allAccounts.length > 0 && filteredAccounts.length === 0">
                    {{-- No Results State --}}
                    <div class="p-12 text-center">
                        <x-icon name="ghost" class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" />
                        <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">No accounts found</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Try adjusting your filters or search term.
                        </p>
                    </div>
                </template>

                <template x-if="filteredAccounts.length > 0">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Layer</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Account Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Balance Amount</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Posting</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                <template x-for="account in filteredAccounts" :key="account.id">
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">

                                        {{-- Layer Badge --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <template x-if="account.depth === 1">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                                    Category
                                                </span>
                                            </template>
                                            <template x-if="account.depth > 1">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                                    Level <span x-text="account.depth - 1"></span>
                                                </span>
                                            </template>
                                        </td>

                                        {{-- Account Name --}}
                                        <td class="px-6 py-4">
                                            <div class="flex items-center"
                                                :style="`padding-left: ${(account.depth - 1) * 24}px`">
                                                <template x-if="account.depth > 1">
                                                    <svg class="w-3 h-3 text-gray-400 mr-2 flex-shrink-0" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </template>
                                                <div class="min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate"
                                                        x-text="account.name"></p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400"
                                                        x-text="account.code">
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Balance --}}
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700 dark:text-gray-300">
                                            ₱0.00
                                        </td>

                                        {{-- Posting --}}
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 dark:text-gray-500">
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 dark:bg-green-900/30"
                                                title="Posted">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </td>

                                        {{-- Status --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 dark:bg-green-900/30"
                                                title="Active">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="flex items-center justify-end gap-1">
                                                <button type="button"
                                                    class="p-1.5 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                                                    title="Edit">
                                                    <x-icon name="edit" class="w-4 h-4" />
                                                </button>
                                                <button type="button"
                                                    class="p-1.5 text-gray-500 hover:text-purple-600 dark:text-gray-400 dark:hover:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/20 rounded-lg transition-colors"
                                                    title="Report">
                                                    <x-icon name="report_btn" class="w-4 h-4" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </template>
            </div>
        </div>
    </div>
    @include('coa.modal.add_accounts')


    <script>
        function chartOfAccounts(allAccounts) {
            return {
                // All accounts data (from server)
                allAccounts: allAccounts,

                // Filter state
                selectedTab: 'all', // 'all' or account ID
                selectedLevel: 'all', // 'all', 'top', 'level1', etc.
                searchTerm: '', // Search input

                // Map level filter to depth number
                levelDepthMap: {
                    'top': 1,
                    'level1': 2,
                    'level2': 3,
                    'level3': 4,
                    'level4': 5,
                },

                // Select a tab
                selectTab(tabId) {
                    this.selectedTab = tabId;
                    // Optional: Reset level filter when tab changes
                    // this.selectedLevel = 'all';
                },

                // Filtered accounts (computed automatically)
                get filteredAccounts() {
                    let accounts = this.allAccounts;

                    // STEP 1: Filter by TYPE (tab)
                    if (this.selectedTab !== 'all') {
                        // Show accounts that BELONG to the selected tab
                        // (including all ancestors down to the selected level)
                        accounts = this.filterByType(accounts, this.selectedTab);
                    }

                    // STEP 2: Filter by LEVEL
                    if (this.selectedLevel !== 'all') {
                        accounts = this.filterByLevel(accounts);
                    }

                    // STEP 3: Filter by SEARCH (on already filtered data)
                    if (this.searchTerm.trim() !== '') {
                        accounts = this.filterBySearch(accounts, this.searchTerm);
                    }

                    return accounts;
                },

                // Filter: Show accounts that belong to the selected type
                filterByType(accounts, tabId) {
                    return accounts.filter(account => {
                        // Check if this account OR any of its ancestors match the tab
                        let current = account;
                        while (current) {
                            if (current.id === tabId) return true;
                            if (current.root_id === tabId) return true;
                            // Move up the parent chain
                            if (current.parent_id === null) break;
                            current = this.allAccounts.find(a => a.id === current.parent_id);
                        }
                        return false;
                    });
                },

                // Filter: Show accounts at the selected level + all ancestors
                filterByLevel(accounts) {
                    const targetDepth = this.levelDepthMap[this.selectedLevel];

                    return accounts.filter(account => {
                        // Show accounts at the target depth
                        if (account.depth === targetDepth) return true;

                        // Show ancestors (depths 1 to target-1)
                        if (account.depth < targetDepth) {
                            // Only show if they have a descendant at the target depth
                            return this.hasDescendantAtDepth(account, targetDepth);
                        }

                        return false;
                    });
                },

                // Check if an account has a descendant at a specific depth
                hasDescendantAtDepth(account, targetDepth) {
                    if (account.depth >= targetDepth) return false;

                    // Check if any account at the target depth has this account as an ancestor
                    return this.allAccounts.some(a => {
                        if (a.depth !== targetDepth) return false;

                        // Walk up from 'a' to see if 'account' is an ancestor
                        let current = a;
                        while (current && current.parent_id !== null) {
                            if (current.parent_id === account.id) return true;
                            current = this.allAccounts.find(acc => acc.id === current.parent_id);
                        }
                        return false;
                    });
                },

                // Filter: Search by name or code
                filterBySearch(accounts, term) {
                    const searchLower = term.toLowerCase();
                    return accounts.filter(account => {
                        return account.name.toLowerCase().includes(searchLower) ||
                            account.code.toLowerCase().includes(searchLower);
                    });
                },
            }
        }
    </script>
    <script>
        function accountForm() {
            return {
                // State
                level: null,
                loading: false,
                code: '',
                name: '',
                description: '',

                // Dropdowns
                dropdowns: {
                    1: '',
                    2: '',
                    3: '',
                    4: ''
                },
                children: {
                    1: [],
                    2: [],
                    3: [],
                    4: []
                },

                // Computed
                get finalParentId() {
                    if (this.level === null) return '';
                    return this.dropdowns[this.level] || '';
                },

                // Level Management
                async selectLevel(newLevel) {
                    this.level = (this.level === newLevel) ? null : newLevel;
                    this.resetDropdowns();
                    if (this.level === null) {
                        await this.fetchNextCode();
                    } else if (this.level >= 1) {
                        await this.fetchTopLevel();
                    }
                },

                resetDropdowns() {
                    this.dropdowns = {
                        1: '',
                        2: '',
                        3: '',
                        4: ''
                    };
                    this.children = {
                        1: [],
                        2: [],
                        3: [],
                        4: []
                    };
                    this.code = '';
                },

                // Dropdown Cascading
                async onDropdownChange(num) {
                    if (!this.dropdowns[num]) return;
                    this.resetDeeperDropdowns(num);
                    const nextDropdown = num + 1;
                    if (nextDropdown <= 4 && this.level >= nextDropdown) {
                        await this.fetchChildren(this.dropdowns[num], nextDropdown);
                    }
                    await this.fetchNextCode();
                },

                resetDeeperDropdowns(num) {
                    for (let i = num + 1; i <= 4; i++) {
                        this.dropdowns[i] = '';
                        this.children[i] = [];
                    }
                },

                // API Calls
                async fetchTopLevel() {
                    this.loading = true;
                    try {
                        const response = await fetch('{{ route('api.accounts.top-level') }}');
                        this.children[1] = await response.json();
                    } catch (error) {
                        console.error('Error:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                async fetchChildren(parentId, targetDropdown) {
                    this.loading = true;
                    try {
                        const response = await fetch(`/api/accounts/${parentId}/children`);
                        this.children[targetDropdown] = await response.json();
                    } catch (error) {
                        console.error('Error:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                async fetchNextCode() {
                    this.loading = true;
                    try {
                        const response = await fetch('{{ route('api.accounts.next-code') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ||
                                    '',
                            },
                            body: JSON.stringify({
                                parent_id: this.finalParentId || null
                            }),
                        });
                        const data = await response.json();
                        if (data.success) this.code = data.code;
                    } catch (error) {
                        console.error('Error:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                // Validation
                isFormValid() {
                    if (!this.code?.trim() || !this.name?.trim()) return false;
                    if (this.level !== null && !this.dropdowns[this.level]) return false;
                    return true;
                },

                // Reset
                resetForm() {
                    this.level = null;
                    this.dropdowns = {
                        1: '',
                        2: '',
                        3: '',
                        4: ''
                    };
                    this.children = {
                        1: [],
                        2: [],
                        3: [],
                        4: []
                    };
                    this.code = '';
                    this.name = '';
                    this.description = '';
                },

                // Submit
                async submitForm(event) {
                    this.loading = true;
                    const form = event.target;
                    const formData = new FormData(form);
                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });
                        const data = await response.json();
                        if (data.success) {
                            window.dispatchEvent(new CustomEvent('close-modal-new-account'));
                            setTimeout(() => window.location.reload(), 500);
                        } else if (data.errors) {
                            this.showErrors(data.errors);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                showErrors(errors) {
                    document.querySelectorAll('[data-error]').forEach(el => el.remove());
                    document.querySelectorAll('.border-red-500').forEach(el =>
                        el.classList.remove('border-red-500', 'dark:border-red-500'));
                    Object.keys(errors).forEach(field => {
                        const input = document.querySelector(`[name="${field}"]`);
                        if (input) {
                            input.classList.add('border-red-500', 'dark:border-red-500');
                            const errorMsg = document.createElement('p');
                            errorMsg.setAttribute('data-error', 'true');
                            errorMsg.className = 'mt-1 text-xs text-red-600 dark:text-red-400';
                            errorMsg.textContent = errors[field][0];
                            input.parentNode.appendChild(errorMsg);
                        }
                    });
                }
            }
        }
    </script>

</x-app-layout>
