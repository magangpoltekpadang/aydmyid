<form action="{{ route('staff.store') }}" method="POST"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Add New Service</h2>


    {{-- Name --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-code" aria-hidden="true"></i>
        </span>
        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Name"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Email --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-code" aria-hidden="true"></i>
        </span>
        <input type="emial" id="email" name="email" value="{{ old('email') }}" placeholder="Email"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Phone Number --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-code" aria-hidden="true"></i>
        </span>
        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Password --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-code" aria-hidden="true"></i>
        </span>
        <input type="password" id="password_hash" name="password_hash" value="{{ old('password_hash') }}" placeholder="Password"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Outlet Id --}}
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

    {{-- Role Id --}}
    <div class="relative mb-4">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-clock" aria-hidden="true"></i>
        </span>
        <select id="role_id" name="role_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
            @foreach ($roles as $role)
                <option value="{{ $role->role_id }}"
                    {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                    {{ $role->role_id }} {{ $role->role_name ?? 'ID not found' }}
                </option>
            @endforeach
        </select>
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
    <script src="{{ asset('js/staff/staff-script.js') }}"></script>
@endpush
