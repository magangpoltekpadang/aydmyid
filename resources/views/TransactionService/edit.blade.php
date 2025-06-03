<form @submit.prevent="updateTransactionService"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Edit Transaction Service</h2>

    {{-- Transaction Id --}}
    <div>
        <label for="transaction_id" class="block mb-1 font-semibold">Transaction Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-store" aria-hidden="true"></i>
            </span>
            <select x-model="editedTransactionService.transaction_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih transaction --</option>
                <template x-for="transaction in transactions" :key="transaction.transaction_id">
                    <option :value="transaction.transaction_id" x-text="transaction.transaction_id + ' ' + transaction.transaction_code"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Service Id --}}
    <div>
        <label for="service_id" class="block mb-1 font-semibold">Service Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-store" aria-hidden="true"></i>
            </span>
            <select x-model="editedTransactionService.service_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih service --</option>
                <template x-for="service in services" :key="service.service_id">
                    <option :value="service.service_id" x-text="service.service_id + ' ' + service.service_name"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Quantity --}}
    <div>
        <label for="quantity" class="block mb-1 font-semibold">Quantity</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedTransactionService.quantity"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{--  Unit Price --}}
    <div>
        <label for="unit_price" class="block mb-1 font-semibold"> Unit Price</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedTransactionService.unit_price"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Discount --}}
    <div>
        <label for="discount" class="block mb-1 font-semibold">Discount</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedTransactionService.discount"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Worker Id --}}
    <div>
        <label for="worker_id" class="block mb-1 font-semibold">Worker Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-store" aria-hidden="true"></i>
            </span>
            <select x-model="editedTransactionService.worker_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih service --</option>
                <template x-for="staff in staffs" :key="staff.staff_id">
                    <option :value="staff.staff_id" x-text="staff.staff_id + ' ' + staff.name"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Start Time --}}
    <div>
        <label for="start_time" class="block mb-1 font-semibold">Start Time</label>
        <input type="time" x-model="editedTransactionService.start_time"
            class="w-full border rounded px-3 py-2" required>
        @error('start_time')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- End Time --}}
    <div>
        <label for="end_time" class="block mb-1 font-semibold">End Time</label>
        <input type="time" x-model="editedTransactionService.end_time"
            class="w-full border rounded px-3 py-2" required>
        @error('end_time')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Notes --}}
    <div>
        <label for="notes" class="block mb-1 font-semibold">Notes</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedTransactionService.notes"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex justify-between items-center">
        <button @click="showEditModal = false"
            class="text-sm font-semibold text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition transition">Cencle
        </button>
        <button @click="updateTransactionService()"
            class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Update
        </button>
    </div>

</form>
