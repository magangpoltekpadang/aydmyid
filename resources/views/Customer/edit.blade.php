<form @submit.prevent="updateCustomer"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Edit Customer</h2>

    {{--  Plate Number --}}
    <div>
        <label for="plate_number" class="block mb-1 font-semibold">Plate Number</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-comment" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedCustomer.plate_number"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Name --}}
    <div>
        <label for="name" class="block mb-1 font-semibold">Name</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-comment" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedCustomer.name"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Phone Number --}}
    <div>
        <label for="phone_number" class="block mb-1 font-semibold">Phone Number</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-comment" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedCustomer.phone_number"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Vehicle Type Id --}}
    <div>
        <label for="vehicle_type_id" class="block mb-1 font-semibold">Vehicle Type Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-id-card" aria-hidden="true"></i>
            </span>
            <select x-model="editedCustomer.vehicle_type_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih Vehicle Type --</option>
                <template x-for="vehicleType in vehicleTypes" :key="vehicleType.vehicle_type_id">
                    <option :value="vehicleType.vehicle_type_id"
                        x-text="vehicleType.vehicle_type_id + ' ' + vehicleType.type_name"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Vehicle Color --}}
    <div>
        <label for="vehicle_color" class="block mb-1 font-semibold">Vehicle Color</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-comment" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedCustomer.vehicle_color"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Checkbox Aktif --}}
    <label class="inline-flex items-center">
        <input type="checkbox" x-model="editedCustomer.is_member" class="form-checkbox">
        <span class="ml-2">Member</span>
    </label>

    {{-- Tombol Aksi --}}
    <div class="flex justify-between items-center">
        <button @click="showEditModal = false"
            class="text-sm font-semibold text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition transition">Cencle
        </button>
        <button @click="updateCustomer()"
            class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Update
        </button>
    </div>

</form>
