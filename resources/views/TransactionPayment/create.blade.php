<form action="{{ route('transaction-payment.store') }}" method="POST"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Add New Transaction Payment</h2>


    {{-- Transaction Id --}}
    <div>
        <label for="transaction_id" class="block mb-1 font-semibold">Transaction Id</label>
        <div class="relative mb-4">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-store" aria-hidden="true"></i>
            </span>
            <select id="transaction_id" name="transaction_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
                @foreach ($transactions as $transaction)
                    <option value="{{ $transaction->transaction_id }}"
                        {{ old('transaction_id') == $transaction->transaction_id ? 'selected' : '' }}>
                        {{ $transaction->transaction_id }} {{ $transaction->transaction_code ?? 'ID not found' }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Payment Method Id --}}
    <div>
        <label for="payment_method_id" class="block mb-1 font-semibold">Payment Method Id</label>
        <div class="relative mb-4">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-credit-card" aria-hidden="true"></i>
            </span>
            <select id="payment_method_id" name="payment_method_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
                @foreach ($payment_methods as $payment_method)
                    <option value="{{ $payment_method->payment_method_id }}"
                        {{ old('payment_method_id') == $payment_method->payment_method_code ? 'selected' : '' }}>
                        {{ $payment_method->payment_method_id }} {{ $payment_method->method_name ?? 'ID not found' }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Amount --}}
    <div>
        <label for="amount" class="block mb-1 font-semibold">Amount</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-money-bill-wave" aria-hidden="true"></i>
            </span>
            <input type="text" id="amount" name="amount" value="{{ old('amount') }}" placeholder="Amount"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Payment Date --}}
    <div>
        <label for="payment_date" class="block mb-1 font-semibold"> Payment Date</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-calendar-alt" aria-hidden="true"></i>
            </span>
            <input type="date" id="payment_date" name="payment_date" value="{{ old('payment_date') }}"
                placeholder="Payment Date"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Status Id --}}
    <div>
        <label for="status_id" class="block mb-1 font-semibold">Status</label>
        <div class="relative mb-4">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-tasks" aria-hidden="true"></i>
            </span>
            <select id="status_id" name="status_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 bg-white border border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
                @foreach ($transaction_services as $transaction_service)
                    <option value="{{ $transaction_service->transaction_service_id }}"
                        {{ old('transaction_service_id') == $transaction_service->transaction_service_id ? 'selected' : '' }}>
                        {{ $transaction_service->transaction_service_id }} - {{ ucfirst($transaction_service->status) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Notes --}}
    <div>
        <label for="notes" class="block mb-1 font-semibold">Notes</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-comment-dots" aria-hidden="true"></i>
            </span>
            <input type="text" id="notes" name="notes" value="{{ old('notes') }}"
                placeholder="Notes"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex justify-between items-center">
        <button @click="showCreateModal = false"
            class="text-sm font-semibold text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition transition">Cencle
        </button>
        <button type="submit"
            class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Submit
        </button>
    </div>

</form>

@push('scripts')
    <script src="{{ asset('js/transactionpayment/transaction-payment-script.js') }}"></script>
@endpush
