@extends('layout.main')

@section('content')
<div x-data="{ ...notificationStatusData(), showCreateModal: false, showEditModal: false }" class="space-y-6">
    <!-- Header and Create Button -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Notification Status</h1>
        <button @click="showCreateModal = true;"
                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                + Add Status
            </button>
    </div>

    <!-- Roles Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-white-500 uppercase border-b dark:border-purple-600 bg-purple-50 dark:text-white dark:bg-purple-600">
                      <th class="px-4 py-3">Status Name</th>
                      <th class="px-4 py-3">Code</th>
                      <th class="px-4 py-3">Description</th>
                      <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-white-700 dark:bg-white-800">
                    <template x-for="(notificationStatus, index) in notificationStatuses" :key="notificationStatus.status_id">
                        <tr class="text-black-500 dark:text-black-100">
                            <td class="px-4 py-3 text-sm text-gray-500" x-text="notificationStatus.status_name"></td>
                            <td class="px-4 py-3 text-sm text-gray-500" x-text="notificationStatus.code"></td>
                            <td class="px-4 py-3 text-sm text-gray-500" x-text="notificationStatus.description || '-'"></td>
                            <td class="px-4 py-3 text-xs">
                                <button @click="startEdit(notificationStatus)" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                <button @click="confirmDelete(notificationStatus.status_id)" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="notificationStatuses.length === 0">
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No Status Found</td>
                    </tr>
                    </tbody>
            </table>
        </div>

    </div>
    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this status?</p>
            <div class="flex justify-end space-x-3">
                <button @click="showDeleteModal = false" 
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                <button @click="deleteNotificationStatus()" 
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>

    <!-- Modal Create-->
    <div x-show="showCreateModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
        <div @click.away="showCreateModal = false" class="bg-white rounded-lg shadow w-full max-w-md mx-4">
            @include('NotificationStatus.create') {{-- Memanggil form dari file create.blade.php --}}
        </div>
    </div>

    <!-- Modal Edit-->
    <div x-show="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
        <div @click.away="showEditModal = false" class="bg-white rounded-lg shadow w-full max-w-md mx-4">
            @include('NotificationStatus.edit') {{-- Memanggil form dari file edit.blade.php --}}
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/notificationstatus/notification-status-script.js') }}">
</script>
@endpush
@endsection