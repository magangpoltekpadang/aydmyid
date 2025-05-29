@extends('layout.main')

@section('content')
    <div x-data="{ ...notificationTypeData(), showCreateModal: false, showEditModal: false }" class="space-y-6">
        <!-- Header and Create Button -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Notification Type</h1>
            <button @click="showCreateModal = true;"
                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                + Add Type
            </button>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Notifications Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-white-800">
                <div
                    class="w-12 h-12 mr-4 flex items-center justify-center text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
                    <i class="fas fa-car text-xl"></i>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-700">Total Notifications</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-600" x-text="pagination.total">
                    </p>
                </div>
            </div>

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-white-800">
                <div
                    class="w-12 h-12 mr-4 flex items-center justify-center text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-700">Active Types</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-600"
                        x-text="notificationTypes.filter(v => v.is_active).length">
                    </p>
                </div>
            </div>

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-white-800">
                <div
                    class="w-12 h-12 mr-4 flex items-center justify-center text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                    <i class="fas fa-times-circle text-xl"></i>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-700">Inactive Types</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-600"
                        x-text="notificationTypes.filter(v => !v.is_active).length">
                    </p>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Field -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                    <input type="text" id="search" x-model="search" placeholder="Type to search..."
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" x-model="status"
                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        <option value="">All</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class ="flex items-end">
                    <button @click="fetchNotificationTypes()"
                        class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                    <button @click="resetFilters()"
                        class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        <i class="fas fa-times mr-2"></i> Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-white-500 uppercase border-b dark:border-purple-600 bg-purple-50 dark:text-white dark:bg-purple-600">
                            <th class="px-4 py-3">Type Name</th>
                            <th class="px-4 py-3">Code</th>
                            <th class="px-4 py-3">Template Text</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-white-700 dark:bg-white-800">
                        <template x-for="(notificationType, index) in notificationTypes" :key="notificationType.notification_type_id">
                            <tr class="text-black-500 dark:text-black-100">
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="notificationType.type_name"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="notificationType.code"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="notificationType.template_text || '-'"></td>
                                <td class="px-4 py-3 text-xs">
                                    <span
                                        x-bind:class="notificationType.is_active ? 'bg-green-600 text-green-100' :
                                            'bg-red-600 text-red-100'"
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        x-text="notificationType.is_active ? 'Active' : 'Inactive'">
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    <button @click="startEdit(notificationType)" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="confirmDelete(notificationType.notification_type_id)"
                                        class="text-red-500 hover:text-red-500">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="notificationTypes.length === 0">
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No Notification Types Found
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
                x-show="pagination.last_page > 1">
                <div x-data class="flex-1 flex justify-between sm:hidden">
                    <button x-show="pagination.current_page > 1" @click="previousPage()"
                        :disabled="pagination.current_page === 1"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button x-show="pagination.current_page < pagination.last_page" @click="nextPage()"
                        :disabled="pagination.current_page === pagination.last_page"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class= "text-sm text-gray-700">
                            Showing <span class="font-medium" x-text="pagination.from"></span> to
                            <span class="font-medium" x-text="pagination.to"></span> of
                            <span class="font-medium" x-text="pagination.total"></span>
                            Results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button @click="changePage(1)" :disabled="pagination.current_page === 1"
                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-angle-left"></i>
                            </button>

                            <template x-for="page in pagination.links" :key="page.label">
                                <button @click="changePage(page.label)"
                                    :disabled="!Number.isInteger(Number(page.label)) || page.active"
                                    :class="page.active ? 'z-10 bg-purple-50 border-purple-500 text-purple-600' :
                                        'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'"
                                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                    x-text="page.label">
                                </button>
                            </template>


                            <button @click="nextPage()" :disabled="pagination.current_page === pagination.last_page"
                                class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <i class="fas fa-angle-right"></i>
                            </button>
                            <button @click="changePage(pagination.last_page)"
                                :disabled="pagination.current_page === pagination.last_page"
                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Last</span>
                                <i class="fas fa-angle-double-right"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this Notification type?</p>
                <div class="flex justify-end space-x-3">
                    <button @click="showDeleteModal = false"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                    <button @click="deleteNotificationType()"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>

        <!-- Modal Create-->
        <div x-show="showCreateModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
            <div @click.away="showCreateModal = false" class="bg-white rounded-lg shadow w-full max-w-md mx-4">
                @include('NotificationType.create') {{-- Memanggil form dari file create.blade.php --}}
            </div>
        </div>

        <!-- Modal Edit-->
        <div x-show="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
            <div @click.away="showEditModal = false" class="bg-white rounded-lg shadow w-full max-w-md mx-4">
                @include('NotificationType.edit') {{-- Memanggil form dari file edit.blade.php --}}
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/notificationtype/notification-type-script.js') }}"></script>
    @endpush
@endsection
