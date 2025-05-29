<form action="{{ route('notification.store') }}" method="POST"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Add New Type</h2>

    {{-- Customer Id --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fa fa-car" aria-hidden="true"></i>
        </span>
        
        <!-- Status Dropdown dengan Alpine.js -->
        <div x-data="{
                notifications: [ customer_id ],
                selectedCustomerId: '{{ old('customer_id') }}'
            }" class="mb-4">

            <select name="customer_id" id="customer_id" x-model="selectedCustomerId"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-500 bg-white border border-white-300 dark:border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
                <option value="">Customer Id</option>
                <template x-for="notification in notifications" :key="notification.customer_id">
                    <option :value="notification.customer_id" x-text="notification.customer_id"></option>
                </template>
            </select>

            <!-- Optional: tampilkan customerId yang dipilih -->
            <p class="text-sm text-gray-600 mt-1" x-show="selectedCustomerId !== ''">
                Selected: <span x-text="selectedCustomerId"></span>
            </p>

            <!-- Error dari Laravel -->
            @error('customer_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>


    {{-- Notification Type Id --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fa fa-key" aria-hidden="true"></i>
        </span>
        <input type="text" id="notification_type_id" name="notification_type_id"
            value="{{ old('notification_type_id') }}" placeholder="Notification Type Id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Message --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fa fa-key" aria-hidden="true"></i>
        </span>
        <input type="text" id="message" name="message" value="{{ old('message') }}" placeholder="Message"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Sent At --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fa fa-key" aria-hidden="true"></i>
        </span>
        <input type="text" id="sent_at" name="sent_at" value="{{ old('sent_at') }}" placeholder="Sent At"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Status Id --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fa fa-car" aria-hidden="true"></i>
        </span>
        <input type="text" id="status_id" name="status_id" value="{{ old('status_id') }}" required
            placeholder="Status Id"
            class="w-full h-11 px-3 pl-9 text-sm text-black bg-white border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>

    {{-- Retry Count --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fa fa-key" aria-hidden="true"></i>
        </span>
        <input type="text" id="retry_Count" name="retry_Count" value="{{ old('retry_Count') }}"
            placeholder="Retry Count"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
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
    <script src="{{ asset('js/notification/notification-script.js') }}"></script>
@endpush