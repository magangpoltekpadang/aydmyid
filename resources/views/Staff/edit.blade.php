<form @submit.prevent="updateStaff"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Edit Staff</h2>


    {{-- Name --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-user" aria-hidden="true"></i>
        </span>
        <input type="text" x-model="editedStaff.name"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
    </div>

    {{--Email --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-envelope" aria-hidden="true"></i>
        </span>
        <input type="email" x-model="editedStaff.email"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
    </div>

    {{-- Phone Number --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-phone" aria-hidden="true"></i>
        </span>
        <input type="text" x-model="editedStaff.phone_number"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
    </div>
    
    {{--Password --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-lock" aria-hidden="true"></i>
        </span>
        <input type="password" x-model="editedStaff.password_hash"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
    </div>

    {{-- Outlet Id --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-store" aria-hidden="true"></i>
        </span>
        <select x-model="editedStaff.outlet_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
            <option disabled value="">-- Pilih outlet --</option>
            <template x-for="outlet in outlets" :key="outlet.outlet_id">
                <option :value="outlet.outlet_id" x-text="outlet.outlet_id + ' ' + outlet.outlet_name"></option>
            </template>
        </select>
    </div>

    {{--Role Id --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
            <i class="fas fa-user-tag" aria-hidden="true"></i>
        </span>
        <select x-model="editedStaff.role_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
            <option disabled value="">-- Pilih role --</option>
            <template x-for="role in roles" :key="role.role_id">
                <option :value="role.role_id" x-text="role.role_id + ' ' + role.role_name"></option>
            </template>
        </select>
    </div>

    {{-- Checkbox Aktif --}}
    <label class="inline-flex items-center">
                <input type="checkbox" x-model="editedStaff.is_active" class="form-checkbox">
                <span class="ml-2">Active</span>
            </label>

    {{-- Tombol Aksi --}}
    <div class="flex justify-between items-center">
        <button @click="showEditModal = false"
            class="text-sm font-semibold text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition transition">Cencle
        </button>
        <button @click="updateStaff()"
            class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Update
        </button>
    </div>

</form>
