<form @submit.prevent="updateServiceType"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Edit Type</h2>

    {{-- Type Name --}}
    <div>
        <label for="type_name" class="block mb-1 font-semibold">Type Name</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fa fa-car" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedServiceType.type_name"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Code --}}
    <div>
        <label for="code" class="block mb-1 font-semibold">Code</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fa fa-key" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedServiceType.code"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="block mb-1 font-semibold">Description</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fa fa-file-alt" aria-hidden="true"></i>
            </span>
            <textarea type="text" x-model="editedServiceType.description"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm"></textarea>
        </div>
    </div>

    {{-- Checkbox Aktif --}}
    <label class="inline-flex items-center">
        <input type="checkbox" x-model="editedServiceType.is_active" class="form-checkbox">
        <span class="ml-2">Active</span>
    </label>

    {{-- Tombol Aksi --}}
    <div class="flex justify-between items-center">
        <button @click="showEditModal = false"
            class="text-sm font-semibold text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition transition">Cencle
        </button>
        <button @click="updateServiceType()"
            class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Update
        </button>
    </div>

</form>
