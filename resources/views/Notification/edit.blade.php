<form @submit.prevent="updateNotification"
    class="rounded-xl border border-gray-200 dark:bg-white-900 dark:border-white p-5 space-y-5 shadow-sm">
    @csrf
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray">Edit Type</h2>

    {{-- Customer Id --}}
    <div>
        <label for="customer_id" class="block mb-1 font-semibold">Customer Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-id-card" aria-hidden="true"></i>
            </span>
            <select x-model="editedNotification.customer_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih Customer --</option>
                <template x-for="customer in customers" :key="customer.customer_id">
                    <option :value="customer.customer_id" x-text="customer.customer_id + ' ' + customer.name"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Notification Type Id --}}
    <div>
        <label for="notification_type_id" class="block mb-1 font-semibold">Notification Type Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-bell" aria-hidden="true"></i>
            </span>
            <select x-model="editedNotification.notification_type_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih NotificationType --</option>
                <template x-for="notificationType in notificationTypes" :key="notificationType.notification_type_id">
                    <option :value="notificationType.notification_type_id"
                        x-text="notificationType.notification_type_id + ' ' + notificationType.type_name"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Message --}}
    <div>
        <label for="message" class="block mb-1 font-semibold">Message</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-comment" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedNotification.message"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Status Id --}}
    <div>
        <label for="status_id" class="block mb-1 font-semibold">Status Id</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-info-circle" aria-hidden="true"></i>
            </span>
            <select x-model="editedNotification.status_id"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm">
                <option disabled value="">-- Pilih Status --</option>
                <template x-for="notificationStatus in notificationStatuses" :key="notificationStatus.status_id">
                    <option :value="notificationStatus.status_id"
                        x-text="notificationStatus.status_id + ' ' + notificationStatus.status_name"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Retry Count --}}
    <div>
        <label for="retry_count" class="block mb-1 font-semibold">Retry Count</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fas fa-sync" aria-hidden="true"></i>
            </span>
            <input type="text" x-model="editedNotification.retry_count"
                class="w-full h-11 px-3 pl-9 text-sm text-gray-800 dark:text-grey-600 bg-white dark:bg-white-800 border border-white-300 dark:border-gray-700 rounded-md shadow-sm" />
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex justify-between items-center">
        <button @click="showEditModal = false"
            class="text-sm font-semibold text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition transition">Cencle
        </button>
        <button @click="updateNotification()"
            class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Update
        </button>
    </div>

</form>
