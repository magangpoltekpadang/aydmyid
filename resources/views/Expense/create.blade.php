<form action="{{ route('expense.store') }}" method="POST"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Add New Expense</h2>


    {{-- Expense Code --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-code" aria-hidden="true"></i>
        </span>
        <input type="text" id="expense_code" name="expense_code" value="{{ old('expense_code') }}" placeholder="Expense Code"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Outlet Id --}}
    <div class="relative mb-4">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-store" aria-hidden="true"></i>
        </span>
        <select id="outlet_id" name="outlet_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
            @foreach ($outlets as $outlet)
                <option value="{{ $outlet->outlet_id }}"
                    {{ old('outlet_id') == $outlet->outlet_id ? 'selected' : '' }}>
                    {{ $outlet->outlet_id }} {{ $outlet->outlet_name ?? 'ID not found' }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Amount --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-money-bill-wave" aria-hidden="true"></i>
        </span>
        <input type="text" id="amount" name="amount" value="{{ old('amount') }}" placeholder="Amount"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Category --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-tags" aria-hidden="true"></i>
        </span>
        <input type="text" id="category" name="category" value="{{ old('category') }}" placeholder="Category"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Description --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-align-left" aria-hidden="true"></i>
        </span>
        <input type="text" id="description" name="description" value="{{ old('description') }}" placeholder="Description"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Staff Id --}}
    <div class="relative mb-4">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-user" aria-hidden="true"></i>
        </span>
        <select id="staff_id" name="staff_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
            @foreach ($staff as $staffs)
                <option value="{{ $staffs->staff_id }}"
                    {{ old('staff_id') == $staffs->staff_id ? 'selected' : '' }}>
                    {{ $staffs->staff_id }} {{ $staffs->name ?? 'ID not found' }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Shift Id --}}
    <div class="relative mb-4">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-clock" aria-hidden="true"></i>
        </span>
        <select id="shift_id" name="shift_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
            @foreach ($shifts as $shift)
                <option value="{{ $shift->shift_id }}"
                    {{ old('shift_id') == $shift->shift_id ? 'selected' : '' }}>
                    {{ $shift->shift_id }} {{ $shift->shift_name ?? 'ID not found' }}
                </option>
            @endforeach
        </select>
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
    <script src="{{ asset('js/expense/expense-script.js') }}"></script>
@endpush
