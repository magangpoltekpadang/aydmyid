<form @submit.prevent="updateTransactionPayment"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Edit Transaction Payment</h2>


    {{-- Transaction Id --}}
    <div>
        <label for="transaction_id" class="block mb-1 font-semibold">Transaction Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-store" aria-hidden="true"></i>
            </span>
            <select x-model="editedTransactionPayment.transaction_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih Payment Method Id --</option>
                <template x-for="transaction in transactions" :key="transaction.transaction_id">
                    <option :value="transaction.transaction_id" x-text="transaction.transaction_id + ' ' + transaction.transaction_code"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Payment Method Id --}}
    <div>
        <label for="payment_method_id" class="block mb-1 font-semibold">Payment Method Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-credit-card" aria-hidden="true"></i>
            </span>
            <select x-model="editedTransactionPayment.payment_method_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih Payment Method Id --</option>
                <template x-for="paymentMethod in paymentMethods" :key="paymentMethod.payment_method_id">
                    <option :value="paymentMethod.payment_method_id" x-text="paymentMethod.payment_method_id + ' ' + paymentMethod.methode_name"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Amount --}}
    <div>
        <label for="amount" class="block mb-1 font-semibold">Amount</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-money-bill-wave" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedTransactionPayment.amount"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Payment Date --}}
    <div>
        <label for="payment_date" class="block mb-1 font-semibold"> Payment Date</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-calendar-alt" aria-hidden="true"></i>
            </span>
            <input type="date" x-model="editedTransactionPayment.payment_date"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Status Id --}}
    <div>
        <label for="status_id" class="block mb-1 font-semibold">Status Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-tasks" aria-hidden="true"></i>
            </span>
            <select name="status_id" x-model="editedTransactionPayment.status_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih Payment Method Id --</option>
                <template x-for="service in transactionServices" :key="service.transaction_service_id">
                    <option :value="service.transaction_service_id" x-text="service.status"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Notes --}}
    <div>
        <label for="notes" class="block mb-1 font-semibold">Notes</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-comment-dots" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedTransactionPayment.notes"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>


    {{-- Tombol Aksi --}}
    <div class="flex justify-between items-center">
        <button @click="showEditModal = false"
            class="text-sm font-semibold text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition transition">Cencle
        </button>
        <button @click="updateTransactionPayment()"
            class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Update
        </button>
    </div>

</form>
