<form @submit.prevent="updateShift"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Edit Shift</h2>

    {{-- Outlet Id --}}
    <div>
        <label for="outlet_id" class="block mb-1 font-semibold">Outlet Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-store" aria-hidden="true"></i>
            </span>
            <select x-model="editedShift.outlet_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih outlet --</option>
                <template x-for="outlet in outlets" :key="outlet.outlet_id">
                    <option :value="outlet.outlet_id" x-text="outlet.outlet_id + ' ' + outlet.outlet_name"></option>
                </template>
            </select>
        </div>
    </div>


    {{-- Shift Name --}}
    <div>
        <label for="shift_name" class="block mb-1 font-semibold">Shift Name</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedShift.shift_name"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Start Time --}}
    <div>
        <label for="start_time" class="block mb-1 font-semibold">Start Time</label>
        <input type="time" x-model="editedShift.start_time"
            class="w-full border rounded px-3 py-2" required>
        @error('start_time')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- End Time --}}
    <div>
        <label for="end_time" class="block mb-1 font-semibold">End Time</label>
        <input type="time" x-model="editedShift.end_time"
            class="w-full border rounded px-3 py-2" required>
        @error('end_time')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Checkbox Aktif --}}
    <label class="inline-flex items-center">
        <input type="checkbox" x-model="editedShift.is_active" class="form-checkbox">
        <span class="ml-2">Active</span>
    </label>

    {{-- Tombol Aksi --}}
    <div class="flex justify-between items-center">
        <button @click="showEditModal = false"
            class="text-sm font-semibold text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition transition">Cencle
        </button>
        <button @click="updateShift()"
            class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Update
        </button>
    </div>

</form>
