<form action="{{ route('transaction-service.store') }}" method="POST"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Add New Transaction Service</h2>


    {{-- Transaction Id --}}
    <div>
        <label for="transaction_id" class="block mb-1 font-semibold">Transaction Id</label>
        <div class="relative mb-">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-receipt" aria-hidden="true"></i>
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

    {{-- Service Id --}}
    <div>
        <label for="service_id" class="block mb-1 font-semibold">Service Id</label>
        <div class="relative mb-">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-concierge-bell" aria-hidden="true"></i>
            </span>
            <select id="service_id" name="service_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
                @foreach ($services as $service)
                    <option value="{{ $service->service_id }}"
                        {{ old('service_id') == $service->service_id ? 'selected' : '' }}>
                        {{ $service->service_id }} {{ $service->service_name ?? 'ID not found' }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>


    {{-- Quantity --}}
    <div>
        <label for="quantity" class="block mb-1 font-semibold">Quantity</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-sort-numeric-up" aria-hidden="true"></i>
            </span>
            <input type="text" id="quantity" name="quantity" value="{{ old('quantity') }}" placeholder="Quantity"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Unit Price --}}
    <div>
        <label for="unit_price" class="block mb-1 font-semibold">Unit Price</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-dollar-sign" aria-hidden="true"></i>
            </span>
            <input type="text" id="unit_price" name="unit_price" value="{{ old('unit_price') }}"
                placeholder="Unit Price"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Discount --}}
    <div>
        <label for="discount" class="block mb-1 font-semibold">Discount</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-percent" aria-hidden="true"></i>
            </span>
            <input type="text" id="discount" name="discount" value="{{ old('discount') }}" placeholder="Discount"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Worker Id --}}
    <div>
        <label for="worker_id" class="block mb-1 font-semibold">Worker Id</label>
        <div class="relative mb-">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-user-cog" aria-hidden="true"></i>
            </span>
            <select id="worker_id" name="worker_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->staff_id }}"
                        {{ old('staff_id') == $staff->staff_id ? 'selected' : '' }}>
                        {{ $staff->staff_id }} {{ $staff->name ?? 'ID not found' }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Start Time --}}
    <div>
        <label for="start_time" class="block mb-1 font-semibold">Start Time</label>
        <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
            class="w-full border rounded px-3 py-2" required>
        @error('start_time')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- End Time --}}
    <div>
        <label for="end_time" class="block mb-1 font-semibold">End Time</label>
        <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
            class="w-full border rounded px-3 py-2" required>
        @error('end_time')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Status --}}
    <div>
        <label for="status" class="block mb-1 font-semibold">Status</label>
        <div class="relative mb-">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-info-circle" aria-hidden="true"></i>
            </span>
            <select id="status" name="status"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
                <option value="" disabled {{ old('status') === null ? 'selected' : '' }}>Pilih Status</option>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>pending</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>in_progress</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>completed</option>
                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>cancelled</option>
            </select>
        </div>
    </div>

    {{-- Notes --}}
    <div>
        <label for="notes" class="block mb-1 font-semibold">Notes</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-sticky-note" aria-hidden="true"></i>
            </span>
            <input type="text" id="notes" name="notes" value="{{ old('notes') }}" placeholder="Notes"
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
    <script src="{{ asset('js/transactionservice/transaction-service-script.js') }}"></script>
@endpush
