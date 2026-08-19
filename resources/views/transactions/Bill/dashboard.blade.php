<x-app-layout>
    @section('title', 'Bill Transaction')
    <x-slot name="header">
        Bill Dashboard
    </x-slot>

    <x-slot name="buttonRoute">
        {{ route('transactions.bill.create') }}
    </x-slot>

    <x-slot name="buttonLabel">
        Create Bill
    </x-slot>

    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="flex items-center">
            <div class="flex-1 max-w-[300px]">
                <div class="relative">
                    <input type="text" placeholder="Search Disbursement Transactions..."
                        class="w-full pl-10 pr-3 py-1.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400 dark:placeholder-gray-500">
                    <x-icon name="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                </div>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-9 gap-4">
            <div class="col-span-2">
                <x-display-card title="Total All" value="100" />
            </div>
            <div class="col-span-2">
                <x-display-card title="Pending" value="100" />
            </div>
            <div class="col-span-2">
                <x-display-card title="Approved" value="100" />
            </div>
            <div class="col-span-3">
                <x-display-card title="Total Disbursed Amount" value="{{ __('P  100') }}" />
            </div>
        </div>
        <div class="flex flex-wrap items-center gap-3 my-4" x-data="{ activeTab: 'all' }">
            <div class="flex flex-wrap gap-1 p-1 bg-gray-200 dark:bg-gray-900/50 rounded-xl">
                <x-mini-tab value="all" icon="list">All</x-mini-tab>
                <x-mini-tab value="pending" icon="clock">Pending</x-mini-tab>
                <x-mini-tab value="approved" icon="thumbs_up">Approved</x-mini-tab>
                <x-mini-tab value="revision" icon="revision">For Revision</x-mini-tab>
                <x-mini-tab value="cancelled" icon="cancelled">Cancelled</x-mini-tab>
            </div>
        </div>
        <div class=" border border-gray-200  dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="overflow-x-auto custom-scrollbar max-h-85">
                <table class="w-full rounded-md border-b border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-200 dark:bg-gray-900 sticky top-0 z-1">
                        <tr>
                            <x-table-head :bordered="true" value="No." />
                            <x-table-head :bordered="true" value="Date" />
                            <x-table-head :bordered="true" value="Bill No." />
                            <x-table-head :bordered="true" value="Affiliate" />
                            <x-table-head :bordered="true" value="Amount" />
                            <x-table-head :bordered="true" value="Status" />
                            <x-table-head :bordered="true" value="Disbursement No." />
                            <x-table-head :bordered="true" value="Status" />
                            <x-table-head :bordered="true" value="Created Details" />
                            <x-table-head :bordered="true" value="Last Updated" />
                            <x-table-head :bordered="true" value="Action" />
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <x-table-data value="1" />
                            <x-table-data value="Jan 1, 2023" />
                            <x-table-data value="B-0001" />
                            <x-table-data value="PLDT" />
                            <x-table-data value="1,000.00" />
                            <x-table-data icon="thumbs_up" value="Approved"
                                contentClass="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full" />
                            <x-table-data value="D-0013" />
                            <x-table-data icon="clock" value="Pending"
                                contentClass="px-3 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 rounded-full" />
                            <x-table-data value="Jane Doe" />
                            <x-table-data value="5 mins." />
                            <x-table-data value="View"
                                contentClass="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-800 rounded-full" />
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
