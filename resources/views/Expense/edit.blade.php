<form @submit.prevent="updateExpense"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Edit Expense</h2>


    {{-- Expense Code --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-code" aria-hidden="true"></i>
        </span>
        <input type="text" x-model="editedExpense.expense_code"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
    </div>

    {{-- Outlet Id --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-store" aria-hidden="true"></i>
        </span>
        <select x-model="editedExpense.outlet_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
            <option disabled value="">-- Pilih outlet --</option>
            <template x-for="outlet in outlets" :key="outlet.outlet_id">
                <option :value="outlet.outlet_id" x-text="outlet.outlet_id + ' ' + outlet.outlet_name"></option>
            </template>
        </select>
    </div>

    {{-- Amount --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-money-bill-wave" aria-hidden="true"></i>
        </span>
        <input type="text" x-model="editedExpense.amount"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
    </div>

    {{-- Category --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-tags" aria-hidden="true"></i>
        </span>
        <input type="text" x-model="editedExpense.category"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
    </div>

    {{-- Description --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-align-left" aria-hidden="true"></i>
        </span>
        <input type="text" x-model="editedExpense.description"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
    </div>

    {{-- Staff Id --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-user" aria-hidden="true"></i>
        </span>
        <select x-model="editedExpense.staff_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
            <option disabled value="">-- Pilih staff --</option>
            <template x-for="staff in staffs" :key="staff.staff_id">
                <option :value="staff.staff_id" x-text="staff.staff_id + ' ' + staff.name"></option>
            </template>
        </select>
    </div>

    {{-- Shift Id --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-clock" aria-hidden="true"></i>
        </span>
        <select x-model="editedExpense.shift_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
            <option disabled value="">-- Pilih shift --</option>
            <template x-for="shift in shifts" :key="shift.shift_id">
                <option :value="shift.shift_id" x-text="shift.shift_id + ' ' + shift.shift_name"></option>
            </template>
        </select>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex justify-between items-center">
        <button @click="showEditModal = false"
            class="text-sm font-semibold text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition transition">Cencle
        </button>
        <button @click="updateExpense()"
            class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Update
        </button>
    </div>

</form>
