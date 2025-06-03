<form action="{{ route('notification-type.store') }}" method="POST"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Add New Type</h2>

    {{-- Type Name --}}
    <div>
        <label for="type_name" class="block mb-1 font-semibold">Type Name</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fa fa-car" aria-hidden="true"></i>
            </span>
            <input type="text" id="type_name" name="type_name" value="{{ old('type_name') }}" required
                placeholder="Type Name"
                class="w-full h-11 px-3 pl-9 text-sm text-black bg-white border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>


    {{-- Code --}}
    <div>
        <label for="code" class="block mb-1 font-semibold">Code</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fa fa-key" aria-hidden="true"></i>
            </span>
            <input type="text" id="code" name="code" value="{{ old('code') }}" placeholder="Code"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Template Text --}}
    <div>
        <label for="template_text" class="block mb-1 font-semibold">Template Text</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fa fa-file-alt" aria-hidden="true"></i>
            </span>
            <input type="text" id="template_text" name="template_text" value="{{ old('template_text') }}"
                placeholder="Template Text"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Checkbox Aktif --}}
    <div x-data="{ isActive: {{ old('is_active', true) ? 'true' : 'false' }} }" class="mb-4">
        <label for="is_active"
            class="flex items-center text-sm font-semibold text-gray-800 dark:text-gray cursor-pointer select-none">
            <div class="relative">
                <input type="checkbox" id="is_active" name="is_active" value="1" x-model="isActive" class="sr-only"
                    :checked="isActive" />
                <div :class="isActive ? 'bg-indigo-600 border-indigo-600' : 'bg-white border-gray-300 dark:border-gray-700'"
                    class="mr-2 flex h-4 w-4 items-center justify-center rounded border transition-colors duration-200">
                    <svg x-show="isActive" class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </div>
            </div>
            Aktifkan
        </label>
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
