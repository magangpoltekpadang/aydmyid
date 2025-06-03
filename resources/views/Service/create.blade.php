<form action="{{ route('service.store') }}" method="POST"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Add New Service</h2>


    {{-- Service Name --}}
    <div>
        <label for="service_name" class="block mb-1 font-semibold">Service Name</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-code" aria-hidden="true"></i>
            </span>
            <input type="text" id="service_name" name="service_name" value="{{ old('service_name') }}"
                placeholder="Service Name"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>


    {{-- Service Type Id --}}
    <div>
        <label for="service_type_id" class="block mb-1 font-semibold">Service Type Id</label>
        <div class="relative mb-4">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-store" aria-hidden="true"></i>
            </span>
            <select id="service_type_id" name="service_type_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
                @foreach ($service_types as $service_type)
                    <option value="{{ $service_type->service_type_id }}"
                        {{ old('service_type_id') == $service_type->service_type_id ? 'selected' : '' }}>
                        {{ $service_type->service_type_id }} {{ $service_type->type_name ?? 'ID not found' }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Price --}}
    <div>
        <label for="price" class="block mb-1 font-semibold">Price</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-money-bill-wave" aria-hidden="true"></i>
            </span>
            <input type="text" id="price" name="price" value="{{ old('price') }}" placeholder="Price"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Estimated Duration --}}
    <div>
        <label for="estimated_duration" class="block mb-1 font-semibold">Estimated Duration</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-tags" aria-hidden="true"></i>
            </span>
            <input type="text" id="estimated_duration" name="estimated_duration"
                value="{{ old('estimated_duration') }}" placeholder="Estimated Duration"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>


    {{-- Description --}}
    <div>
        <label for="description" class="block mb-1 font-semibold">Description</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-align-left" aria-hidden="true"></i>
            </span>
            <input type="text" id="description" name="description" value="{{ old('description') }}"
                placeholder="Description"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>


    {{-- Outlet Id --}}
    <div>
        <label for="outlet_id" class="block mb-1 font-semibold">Outlet Id</label>
        <div class="relative mb-4">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-clock" aria-hidden="true"></i>
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
    </div>


    {{-- Checkbox Aktif --}}
    <div x-data="{ isActive: {{ old('is_active') ? 'true' : 'false' }} }" class="mb-4">
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

@push('scripts')
    <script src="{{ asset('js/service/service-script.js') }}"></script>
@endpush
