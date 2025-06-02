<form action="{{ route('notification.store') }}" method="POST"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Add New Type</h2>

    {{-- CustomerId --}}
    <div class="relative mb-4">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-id-card" aria-hidden="true"></i>
        </span>
        <select id="customer_id" name="customer_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
            @foreach ($customers as $customer)
                <option value="{{ $customer->customer_id }}"
                    {{ old('customer_id') == $customer->customer_id ? 'selected' : '' }}>
                    {{ $customer->customer_id }} {{ $customer->name ?? 'ID not found' }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Notification Type Id --}}
    <div class="relative mb-4">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-bell" aria-hidden="true"></i>
        </span>
        <select id="notification_type_id" name="notification_type_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
            @foreach ($notification_types as $notification_type)
                <option value="{{ $notification_type->notification_type_id }}"
                    {{ old('notification_type_id') == $notification_type->notification_type_id ? 'selected' : '' }}>
                    {{ $notification_type->notification_type_id }} {{ $notification_type->type_name ?? 'ID not found' }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Message --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-comment" aria-hidden="true"></i>
        </span>
        <input type="text" id="message" name="message" value="{{ old('message') }}" placeholder="Message"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300" />
    </div>


    {{-- Status Id --}}
    <div class="relative mb-4">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-info-circle" aria-hidden="true"></i>
        </span>
        <select id="status_id" name="status_id"
            class="w-full h-11 px-3 pl-9 text-sm text-gray-800 text-black bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-300">
            @foreach ($notification_statuses as $notification_status)
                <option value="{{ $notification_status->status_id }}"
                    {{ old('status_id') == $notification_status->status_id ? 'selected' : '' }}>
                    {{ $notification_status->status_id }} {{ $notification_status->status_name ?? 'ID not found' }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Retry Count --}}
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
            <i class="fas fa-sync" aria-hidden="true"></i>
        </span>
        <input type="text" id="retry_count" name="retry_count" value="{{ old('retry_count') }}"
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
