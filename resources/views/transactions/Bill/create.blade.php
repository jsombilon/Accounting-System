<x-app-layout>
    @section('title', 'Bill Transaction')
    <x-slot name="header">
        Bill Create
    </x-slot>

    <x-slot name="buttonRoute">
        {{ route('transactions.bill.dashboard') }}
    </x-slot>

    <x-slot name="buttonLabel">
        Back to Dashboard
    </x-slot>


    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="mx-4 mt-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-500 rounded-md"
            x-data="{
                statusOpen: false,
                toggleStatus() {
                    this.statusOpen = !this.statusOpen;
                }
            }">
            <div class="overflow-x-hidden custom-scrollbar">
                <div class="p-4">
                    <div class="space-y-4 flex gap-4">
                        <div class="flex-1">

                            <div class="grid grid-cols-3 gap-4 mb-2">
                                <x-form-input name="BillNo" label="Bill No." Value="{{ $BillNo }}" required
                                    disabled />
                                <x-form-input name="documentDate" label="Document Date" Value="{{ $BillDate }}"
                                    type="date" required />
                                <x-form-input name="owner" label="Owner" placeholder="-" required />
                            </div>

                            <div class="relative my-4" x-data="{ paymentAccount: false }" @click.outside="paymentAccount = false">
                                {{-- TRIGGER BUTTON --}}
                                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300 mr-1">Affiliate
                                    <span class="text-red-500">*</span>
                                </span>
                                <button type="button" @click="paymentAccount = !paymentAccount"
                                    class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-500 flex items-center justify-between gap-x-3 rounded-md p-2 text-sm font-semibold transition hover:bg-gray-50 dark:hover:bg-gray-600 w-80">

                                    <div class="flex items-center gap-x-3 min-w-0">
                                        <span class="font-bold text-black dark:text-white truncate">-</span>
                                    </div>
                                    <x-icon name="dropdown-icon"
                                        class="w-4 h-4 transition-transform duration-200 shrink-0"
                                        x-bind:class="{ 'rotate-180': paymentAccount }" />
                                </button>

                                {{-- FLOATING DROPDOWN (overlaps Balance) --}}
                                <ul x-show="paymentAccount" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-1" x-cloak
                                    class="absolute left-0 top-full mt-1 w-80 z-50 bg-white dark:bg-gray-700 border border-gray-600 rounded-md shadow-lg overflow-hidden">
                                    <li>
                                        <p
                                            class="break-words p-2 text-md transition text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-900 dark:hover:text-white">
                                            Bill
                                            Payment</p>
                                    </li>
                                    <li>
                                        <p
                                            class="break-words p-2 text-md transition text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-900 dark:hover:text-white">
                                            Bill
                                            Payment</p>
                                    </li>
                                </ul>
                            </div>


                            <div class="grid grid-cols-2 gap-4 mb-2">
                                <x-form-textarea name="remarks" label="Remarks" placeholder="Enter Remarks..."
                                    :rows="4" />
                                <x-form-textarea name="reference" label="Reference" placeholder="Enter Reference..."
                                    :rows="4" />
                            </div>

                            <div class="border-b border-gray-300 dark:border-gray-500 my-6"></div>

                            {{-- Category Table  --}}
                            <Span class="font-bold text-lg ">Category Details</Span>
                            <div>
                                <form method="POST" action="{{ route('transactions.bill.store') }}">
                                    @csrf
                                    <table class="w-full rounded-md border-b border-gray-200 dark:border-gray-900 mb-2">
                                        <thead class="bg-gray-200 dark:bg-gray-700 sticky top-0 z-1">
                                            <tr>
                                                <x-table-head value="Account Name" />
                                                <x-table-head value="Debit" />
                                                <x-table-head value="Credit" />
                                                <x-table-head value="Remarks" />
                                                <x-table-head value="Billable" />
                                                <x-table-head value="Affiliate" />
                                                <x-table-head value="Action" />
                                            </tr>
                                        </thead>
                                        <tbody x-data="{ rows: [{ id: 1 }] }">
                                            <template x-for="(row, index) in rows" :key="row.id">
                                                <tr>
                                                    <td>
                                                        <x-autocomplete name="account_name"
                                                            name-expression="'category_details[' + index + '][account_name]'"
                                                            placeholder="Search account..." :options="$accounts"
                                                            :max-results="3" />
                                                    </td>
                                                    <td>
                                                        <x-number-input name="debit" placeholder="0.00"
                                                            name-expression="'category_details[' + index + '][debit]'"
                                                            :center="true" />
                                                    </td>
                                                    <td>
                                                        <x-number-input name="credit" placeholder="0.00"
                                                            name-expression="'category_details[' + index + '][credit]'"
                                                            :center="true" />
                                                    </td>
                                                    <td>
                                                        <input x-bind:name="'category_details[' + index + '][remarks]'"
                                                            placeholder="Enter remarks..."
                                                            class="text-sm w-full break-words bg-white border text-center border-gray-900 dark:bg-gray-900 text-black dark:text-white px-2 py-1 outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="hidden"
                                                            x-bind:name="'category_details[' + index + '][billable]'"
                                                            value="0">
                                                        <input type="checkbox"
                                                            x-bind:name="'category_details[' + index + '][billable]'"
                                                            value="1"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    </td>

                                                    <td>
                                                        <input x-bind:name="'category_details[' + index + '][affiliate]'"
                                                            placeholder="Enter affiliate..."
                                                            class="text-sm w-full break-words bg-white border text-center border-gray-900 dark:bg-gray-900 text-black dark:text-white px-2 py-1 outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        {{-- Add button (only on last row) --}}
                                                        <button type="button" x-show="index === rows.length - 1"
                                                            @click="rows.push({ id: Date.now() })"
                                                            class="text-green-500 hover:text-green-700 transition-colors p-1"
                                                            title="Add new row">
                                                            <x-icon name="plus" class="w-3 h-3" />
                                                        </button>

                                                        {{-- Delete button (only on other rows) --}}
                                                        <button type="button" x-show="index !== rows.length - 1"
                                                            @click="rows.splice(index, 1)"
                                                            class="text-red-500 hover:text-red-700 transition-colors p-1"
                                                            title="Delete row">
                                                            <x-icon name="trash" class="w-3 h-3" />
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                    <button type="submit"
                                        class="flex items-center gap-2 bg-blue-500 hover:bg-blue-700 px-2 py-1 rounded-sm mb-2">
                                        <x-icon name="plus" />
                                        Save Category
                                    </button>
                                </form>
                                <div class="flex justify-end">
                                    {{-- Total Debit Row --}}
                                    <div
                                        class="inline-flex items-stretch border border-gray-300 dark:border-gray-500 rounded-md overflow-hidden mb-1">
                                        <div
                                            class="bg-gray-200 dark:bg-gray-700 text-sm font-semibold px-2 py-1 border-r border-gray-300 dark:border-gray-500">
                                            Total Debit
                                        </div>
                                        <div class="bg-white dark:bg-gray-500 text-sm font-semibold px-4 py-1">
                                            0.00
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    {{-- Total Credit Row --}}
                                    <div
                                        class="inline-flex items-stretch border border-gray-300 dark:border-gray-500 rounded-md overflow-hidden">
                                        <div
                                            class="bg-gray-200 dark:bg-gray-700 text-sm font-semibold px-2 py-1 border-r border-gray-300 dark:border-gray-500">
                                            Total Credit
                                        </div>
                                        <div class="bg-white dark:bg-gray-500 text-sm font-semibold px-4 py-1">
                                            0.00
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="border-b border-gray-300 dark:border-gray-500 my-6"></div>

                            {{-- Supporting Documents Table  --}}
                            <div class="flex items-center justify-between">
                                <div>
                                    <Span class="font-bold text-lg ">Supporting Documents</Span>
                                </div>
                                <div>
                                    <button
                                        class="flex justify-end bg-green-500 hover:bg-green-700 px-2 py-1 rounded-sm mb-2">
                                        <x-icon name="plus" />
                                    </button>
                                </div>
                            </div>

                            <div class="bg-gray-200 dark:bg-gray-700 p-4">
                                <span>-</span>
                            </div>

                            <x-primary-button class="mt-4">
                                <x-icon name="save" class="w-4 h-4" />
                                Save
                            </x-primary-button>
                        </div>





                        {{-- SIDEBAR STATUS --}}
                        <div class="flex flex-col transition-all duration-300 ease-in-out"
                            :class="statusOpen ? 'w-80' : 'w-20'">

                            <button type="button" @click="toggleStatus()"
                                class="mt-6 flex items-center justify-center mb-2 p-2 border border-gray-300 dark:border-gray-500 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors"
                                :title="statusOpen ? 'Collapse Status' : 'Expand Status'">
                                <span :class="statusOpen ? '' : 'hidden'" class="font-bold">Status</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 transition-transform duration-300"
                                    :class="statusOpen ? 'rotate-180' : 'rotate-0'" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6" />
                                </svg>
                            </button>

                            {{-- Mini Status Indicator (visible when collapsed) --}}
                            <div x-show="!statusOpen" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="px-2 py-2 mt-6 w-full border border-gray-300 dark:border-gray-500 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                {{-- Status Icon --}}
                                <div class="flex items-center justify-center mb-2">
                                    <span
                                        class="rounded-full px-2 py-1 bg-gray-200 dark:bg-gray-400 flex items-center text-xs">
                                        <x-icon name="file-text" class="w-3 h-3" />
                                    </span>
                                </div>

                                {{-- Date --}}
                                <div class="flex items-center justify-center mb-3">
                                    <span class="text-xs">08/07/26</span>
                                </div>

                                {{-- ============================================ --}}
                                {{-- MINI TIMELINE (Collapsed)                    --}}
                                {{-- ============================================ --}}
                                <div class="flex flex-col items-center space-y-1 mt-2">
                                    {{-- Timeline Item 1 --}}
                                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                    <div class="text-[10px] text-gray-600 dark:text-gray-400">Jane</div>

                                    {{-- Connector Line --}}
                                    <div class="w-px h-3 bg-gray-300 dark:bg-gray-600"></div>

                                    {{-- Timeline Item 2 --}}
                                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                    <div class="text-[10px] text-gray-600 dark:text-gray-400">John</div>

                                    {{-- Connector Line --}}
                                    <div class="w-px h-3 bg-gray-300 dark:bg-gray-600"></div>

                                    {{-- Timeline Item 3 --}}
                                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                    <div class="text-[10px] text-gray-600 dark:text-gray-400">Maria</div>
                                </div>
                            </div>


                            {{-- STATUS CONTENT (Collapsible) --}}
                            <div x-show="statusOpen" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="px-4 py-2 mt-5 w-full border border-gray-300 dark:border-gray-500 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <div class="flex items-center gap-2 my-2">
                                    <p class="text-xs">Status:</p>
                                    <span
                                        class="rounded-full px-2 py-1 bg-gray-200 dark:bg-gray-400 flex items-center text-xs">
                                        <x-icon name="file-text" class="w-3 h-3 mr-1" />
                                        Draft
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 mb-2">
                                    <p class="text-xs">Date Approved:</p>
                                    <span class="text-xs">08/07/26</span>
                                </div>

                                <div class="border-b border-gray-300 dark:border-gray-500 mb-2"></div>

                                <div class="flex items-center justify-center mb-4">
                                    <div class="flex-1 text-center font-bold text-sm">Status Trail</div>
                                    <div class="mx-4 h-6 w-px bg-gray-300 dark:bg-gray-600"></div>
                                    <div class="flex-1 text-center font-bold text-sm">Logs</div>
                                </div>
                                {{-- ============================================ --}}
                                {{-- FULL TIMELINE (Expanded) - Centered          --}}
                                {{-- ============================================ --}}
                                <div class="space-y-3 mt-3">

                                    {{-- Timeline Item 1 --}}
                                    <div class="flex gap-3 items-start">
                                        {{-- Left Column: Time + Date (centered) --}}
                                        <div class="flex-1 flex flex-col items-center text-center">
                                            <p class="text-xs font-semibold">2:25pm</p>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400">10/07/26</p>
                                        </div>

                                        {{-- Middle Column: Dot + Line --}}
                                        <div class="flex flex-col items-center shrink-0">
                                            <div
                                                class="w-3 h-3 rounded-full bg-blue-500 border-2 border-white dark:border-gray-700 mt-1">
                                            </div>
                                            <div class="w-px flex-1 bg-gray-300 dark:bg-gray-600 my-1 min-h-[20px]">
                                            </div>
                                        </div>

                                        {{-- Right Column: Name (centered) --}}
                                        <div class="flex-1 flex flex-col items-center text-center">
                                            <p class="text-xs font-semibold">Jane Doe</p>
                                        </div>
                                    </div>

                                    {{-- Timeline Item 2 --}}
                                    <div class="flex gap-3 items-start">
                                        <div class="flex-1 flex flex-col items-center text-center">
                                            <p class="text-xs font-semibold">2:30pm</p>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400">10/07/26</p>
                                        </div>

                                        <div class="flex flex-col items-center shrink-0">
                                            <div
                                                class="w-3 h-3 rounded-full bg-blue-500 border-2 border-white dark:border-gray-700 mt-1">
                                            </div>
                                            <div class="w-px flex-1 bg-gray-300 dark:bg-gray-600 my-1 min-h-[20px]">
                                            </div>
                                        </div>

                                        <div class="flex-1 flex flex-col items-center text-center">
                                            <p class="text-xs font-semibold">John Smith</p>
                                        </div>
                                    </div>

                                    {{-- Timeline Item 3 --}}
                                    <div class="flex gap-3 items-start">
                                        <div class="flex-1 flex flex-col items-center text-center">
                                            <p class="text-xs font-semibold">2:35pm</p>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400">10/07/26</p>
                                        </div>

                                        <div class="flex flex-col items-center shrink-0">
                                            <div
                                                class="w-3 h-3 rounded-full bg-blue-500 border-2 border-white dark:border-gray-700 mt-1">
                                            </div>
                                        </div>

                                        <div class="flex-1 flex flex-col items-center text-center">
                                            <p class="text-xs font-semibold">Maria Santos</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
