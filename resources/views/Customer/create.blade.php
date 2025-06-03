<form action="{{ route('customer.store') }}" method="POST"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Add New Customer</h2>


    {{-- Plate Number --}}
    <div>
        <label for="plate_number" class="block mb-1 font-semibold">Plate Number</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-car" aria-hidden="true"></i>
            </span>
            <input type="text" id="name" name="plate_number" value="{{ old('plate_number') }}"
                placeholder="Plate Number"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Name --}}
    <div>
        <label for="name" class="block mb-1 font-semibold">Name</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Name"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Phone Number --}}
    <div>
        <label for="phone_number" class="block mb-1 font-semibold">Phone Number</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-phone" aria-hidden="true"></i>
            </span>
            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                placeholder="Phone Number"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Vehicle Type Id --}}
    <div>
        <label for="vehicle_type_id" class="block mb-1 font-semibold">Vehicle Type Id</label>
        <div class="relative mb-4">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-truck-monster" aria-hidden="true"></i>
            </span>
            <select id="vehicle_type_id" name="vehicle_type_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
                @foreach ($vehicle_types as $vehicle_type)
                    <option value="{{ $vehicle_type->vehicle_type_id }}"
                        {{ old('vehicle_type_id') == $vehicle_type->vehicle_type_id ? 'selected' : '' }}>
                        {{ $vehicle_type->vehicle_type_id }} {{ $vehicle_type->type_name ?? 'ID not found' }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>


    {{-- Vehicle Color --}}
    <div>
        <label for="vehicle_color" class="block mb-1 font-semibold">Vehicle Color</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                <i class="fas fa-palette" aria-hidden="true"></i>
            </span>
            <input type="text" id="vehicle_color" name="vehicle_color" value="{{ old('vehicle_color') }}"
                placeholder="Vehicle Color"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
        </div>
    </div>

    {{-- Checkbox Aktif --}}
    <div x-data="{ isActive: {{ old('is_member') ? 'true' : 'false' }} }" class="mb-4">
        <label for="is_member"
            class="flex items-center text-sm font-semibold text-gray-800 dark:text-gray cursor-pointer select-none">
            <div class="relative">
                <input type="checkbox" id="is_member" name="is_member" value="1" x-model="isActive" class="sr-only"
                    :checked="isActive" />
                <div :class="isActive ? 'bg-indigo-600 border-indigo-600' : 'bg-white border-gray-300 dark:border-gray-700'"
                    class="mr-2 flex h-4 w-4 items-center justify-center rounded border transition-colors duration-200">
                    <svg x-show="isActive" class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </div>
            </div>
            Member
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
    <script src="{{ asset('js/customer/customer-script.js') }}"></script>
@endpush
