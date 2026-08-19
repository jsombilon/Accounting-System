<aside x-data="{
    hoverTimeout: null,
    hoverExpand() {
        // Only expand if currently collapsed
        if (!this.sideBar) {
            this.hoverTimeout = setTimeout(() => {
                this.sideBar = true;
            }, 1500);
        }
    },
    hoverCancel() {
        if (this.hoverTimeout) {
            clearTimeout(this.hoverTimeout);
            this.hoverTimeout = null;
        }
    }
}" @mouseenter="hoverExpand()" @mouseleave="hoverCancel()" :class="sideBar ? 'w-64' : 'w-20'"
    class="flex flex-col bg-white dark:bg-gray-900 pl-4 pr-2 transition-all duration-300 ease-in-out">

    <div class="py-6 flex items-center gap-2 transition-all duration-200"
        :class="sideBar ? 'justify-start' : 'justify-center'">
        <div class="bg-black dark:bg-white text-white dark:text-black rounded-md p-1 shrink-0">
            <x-icon name="peso" class="w-5 h-5" />
        </div>
        <span x-show="sideBar" class="text-lg font-bold text-black dark:text-white whitespace-nowrap">Accounting
            System</span>
    </div>

    <span class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2">Modules</span>

    <nav class="flex-1 space-y-1">

        <x-sidebar-link href="{{ route('dashboard') }}" icon="dashboard" label="Dashboard" :active="request()->routeIs('dashboard')" />
        <x-sidebar-link href="{{ route('chart-of-accounts') }}" icon="chart" label="Chart of Accounts"
            :active="request()->routeIs('chart-of-accounts')" />
        {{-- Documents Dropdown --}}
        <div x-data="{
            open: {{ request()->routeIs('transactions.*') ? 'true' : 'false' }}
        }" class="space-y-1" @click.outside="open = false">
            <button type="button" @click="if (!sideBar) sideBar = true; open = !open"
                class="w-full flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold transition"
                :class="[
                    open ?
                    'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' :
                    'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700',
                    sideBar ? 'justify-between' : 'justify-center'
                ]">
                <div class="flex items-center gap-x-3">
                    <x-icon name="transactions" class="w-5 h-5 shrink-0" />

                    <span x-show="sideBar" class="font-bold text-black dark:text-white whitespace-nowrap">
                        Transactions Tab
                    </span>
                </div>

                <svg x-show="sideBar" class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 9-7 7-7-7" />
                </svg>
            </button>

            <ul x-show="open && sideBar" x-collapse x-transition class="pl-2 space-y-1">
                <li>
                    <a href="" @click="if (!sideBar) sideBar = true"
                        class="flex items-center gap-x-3 rounded-md p-2 text-sm transition
                        {{ request()->routeIs('transaction.disbursement.dashboard')
                            ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white'
                            : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                        <x-icon name="expense" class="w-4 h-4 shrink-0" />
                        <span>Disbursement</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('transactions.bill.dashboard') }}" @click="if (!sideBar) sideBar = true"
                        class="flex items-center gap-x-3 rounded-md p-2 text-sm transition
                        {{ request()->routeIs('transactions.bill.dashboard')
                            ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white'
                            : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                        <x-icon name="expense" class="w-4 h-4 shrink-0" />
                        <span>Bill</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="relative" x-data="{ accountSettings: false }" @click.outside="accountSettings = false">
        <button @click="if (!sideBar) sideBar = true; accountSettings = !accountSettings"
            class="w-full rounded-lg flex items-center mb-4 p-2.5 text-black dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200"
            :class="sideBar ? 'justify-between' : 'justify-center'">
            <div class="flex items-center gap-3" :class="sideBar ? '' : 'justify-center'">
                <x-icon name="user" class="w-5 h-5 shrink-0" />

                <span x-show="sideBar" class="font-semibold text-sm whitespace-nowrap">
                    {{ auth()->user()->name ?? 'Guest' }}
                </span>
            </div>

            <x-icon x-show="sideBar" name="chevron-down" class="w-4 h-4 transition-transform duration-200"
                x-bind:class="{ 'rotate-180': accountSettings }" />
        </button>

        <div x-show="accountSettings && sideBar" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2" x-cloak
            class="absolute bottom-full left-0 right-2 mb-2 space-y-1 shadow-lg rounded-lg p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between px-3 py-2">
                <span class="text-sm font-semibold text-black dark:text-white">Appearance</span>
                <button @click="$store.darkMode.toggle()" :class="$store.darkMode.on ? 'bg-gray-700' : 'bg-gray-200'"
                    class="relative w-14 h-7 rounded-full transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    aria-label="Toggle dark mode">
                    <span
                        :class="$store.darkMode.on ? 'translate-x-7 bg-gray-900 text-white' : 'translate-x-1 bg-white'"
                        class="absolute top-1 w-5 h-5 rounded-full transition-transform duration-300 flex items-center justify-center text-xs shadow">
                        <span x-text="$store.darkMode.on ? '🌙' : '☀️'"></span>
                    </span>
                </button>
            </div>

            <hr class="border-gray-200 dark:border-gray-700">

            <a href=""
                class="block p-2 rounded-lg text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                Settings
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left block p-2 rounded-lg text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>
