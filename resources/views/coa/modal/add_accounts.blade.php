   <x-modal name="new-account" title="Create New Account" maxWidth="3xl">
       <form id="newAccountForm" method="POST" action="{{ route('chart-of-accounts.store') }}"
           @submit.prevent="submitForm($event)" x-data="accountForm()">
           @csrf

           <input type="hidden" name="parent_id" :value="finalParentId">

           {{-- Level Selector --}}
           <div class="mb-6">
               <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Account Level</label>
               <div class="grid grid-cols-5 gap-2">
                   <button type="button" @click="selectLevel(null)"
                       :class="level === null ? 'bg-blue-600 text-white border-blue-600 shadow-sm' :
                           'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600'"
                       class="px-3 py-2.5 text-sm font-semibold border rounded-lg transition-all">Category</button>
                   <button type="button" @click="selectLevel(1)"
                       :class="level === 1 ? 'bg-blue-600 text-white border-blue-600 shadow-sm' :
                           'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600'"
                       class="px-3 py-2.5 text-sm font-semibold border rounded-lg transition-all">Level 1</button>
                   <button type="button" @click="selectLevel(2)"
                       :class="level === 2 ? 'bg-blue-600 text-white border-blue-600 shadow-sm' :
                           'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600'"
                       class="px-3 py-2.5 text-sm font-semibold border rounded-lg transition-all">Level 2</button>
                   <button type="button" @click="selectLevel(3)"
                       :class="level === 3 ? 'bg-blue-600 text-white border-blue-600 shadow-sm' :
                           'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600'"
                       class="px-3 py-2.5 text-sm font-semibold border rounded-lg transition-all">Level 3</button>
                   <button type="button" @click="selectLevel(4)"
                       :class="level === 4 ? 'bg-blue-600 text-white border-blue-600 shadow-sm' :
                           'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600'"
                       class="px-3 py-2.5 text-sm font-semibold border rounded-lg transition-all">Level 4</button>
               </div>
           </div>

           {{-- Cascading Dropdowns --}}
           <div x-show="level !== null" x-transition.duration.200ms
               class="mb-6 space-y-3 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg">
               <div x-show="level >= 1" x-transition>
                   <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category <span
                           class="text-red-500">*</span></label>
                   <select x-model="dropdowns[1]" @change="onDropdownChange(1)" :disabled="loading"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50">
                       <option value="">-- Select --</option>
                       <template x-for="item in children[1]" :key="item.id">
                           <option :value="item.id" x-text="item.code + ' — ' + item.name"></option>
                       </template>
                   </select>
               </div>
               <div x-show="level >= 2 && dropdowns[1]" x-transition>
                   <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Level 1 <span
                           class="text-red-500">*</span></label>
                   <select x-model="dropdowns[2]" @change="onDropdownChange(2)" :disabled="loading"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50">
                       <option value="">-- Select --</option>
                       <template x-for="item in children[2]" :key="item.id">
                           <option :value="item.id" x-text="item.code + ' — ' + item.name"></option>
                       </template>
                   </select>
               </div>
               <div x-show="level >= 3 && dropdowns[2]" x-transition>
                   <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Level 2 <span
                           class="text-red-500">*</span></label>
                   <select x-model="dropdowns[3]" @change="onDropdownChange(3)" :disabled="loading"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50">
                       <option value="">-- Select --</option>
                       <template x-for="item in children[3]" :key="item.id">
                           <option :value="item.id" x-text="item.code + ' — ' + item.name"></option>
                       </template>
                   </select>
               </div>
               <div x-show="level >= 4 && dropdowns[3]" x-transition>
                   <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Level 3
                       <span class="text-red-500">*</span></label>
                   <select x-model="dropdowns[4]" @change="onDropdownChange(4)" :disabled="loading"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50">
                       <option value="">-- Select --</option>
                       <template x-for="item in children[4]" :key="item.id">
                           <option :value="item.id" x-text="item.code + ' — ' + item.name"></option>
                       </template>
                   </select>
               </div>
           </div>

           {{-- Account Details --}}
           <div class="space-y-4 pt-4 border-t border-gray-200 dark:border-gray-700">
               <div class="grid grid-cols-2 gap-4">
                   <x-form-input name="code" label="Account Code" placeholder="Auto-generated" x-model="code"
                       required />
                   <x-form-input name="name" label="Account Name" placeholder="e.g., Petty Cash" x-model="name"
                       required />
               </div>
               <x-form-textarea name="description" label="Description (Optional)" placeholder="Brief description..."
                   x-model="description" :rows="2" />
           </div>

           {{-- Form Actions --}}
           <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
               <button type="button" @click="resetForm(); $dispatch('close-modal-new-account')"
                   class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">Cancel</button>
               <button type="submit" :disabled="loading || !isFormValid()"
                   :class="(loading || !isFormValid()) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-700'"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                   <span x-show="!loading">Create Account</span>
                   <span x-show="loading" x-cloak class="flex items-center gap-2">
                       <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
                           <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                               stroke-width="4" fill="none" />
                           <path class="opacity-75" fill="currentColor"
                               d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                       </svg>
                       Creating...
                   </span>
               </button>
           </div>
       </form>
   </x-modal>
