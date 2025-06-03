<form @submit.prevent="updateService"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Edit Service</h2>

    {{-- Service Name --}}
    <div>
        <label for="service_name" class="block mb-1 font-semibold">Service Name</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-code" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedService.service_name"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Service Type Id --}}
    <div>
        <label for="service_type_id" class="block mb-1 font-semibold">Service Type Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-store" aria-hidden="true"></i>
            </span>
            <select x-model="editedService.service_type_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih outlet --</option>
                <template x-for="serviceType in serviceTypes" :key="serviceType.service_type_id">
                    <option :value="serviceType.service_type_id"
                        x-text="serviceType.service_type_id + ' ' + serviceType.type_name"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Price --}}
    <div>
        <label for="price" class="block mb-1 font-semibold">Price</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-money-bill-wave" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedService.price"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Estimated Duration --}}
    <div>
        <label for="estimated_duration" class="block mb-1 font-semibold">Estimated Duration</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-tags" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedService.estimated_duration"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="block mb-1 font-semibold">Description</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-align-left" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedService.description"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>


    {{-- Outlet Id --}}
    <div>
        <label for="outlet_id" class="block mb-1 font-semibold">Outlet Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-clock" aria-hidden="true"></i>
            </span>
            <select x-model="editedService.outlet_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih outlet --</option>
                <template x-for="outlet in outlets" :key="outlet.outlet_id">
                    <option :value="outlet.outlet_id" x-text="outlet.outlet_id + ' ' + outlet.outlet_name"></option>
                </template>
            </select>
        </div>
    </div>


    {{-- Checkbox Aktif --}}
    <label class="inline-flex items-center">
        <input type="checkbox" x-model="editedService.is_active" class="form-checkbox">
        <span class="ml-2">Active</span>
    </label>

    {{-- Tombol Aksi --}}
    <div class="flex justify-between items-center">
        <button @click="showEditModal = false"
            class="text-sm font-semibold text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition transition">Cencle
        </button>
        <button @click="updateService()"
            class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Update
        </button>
    </div>

</form>
