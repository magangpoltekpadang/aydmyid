@extends('layout.main')

@section('content')
<div x-data="{ ...roleData()}" x-init="init()" class="space-y-6">
    <!-- Header and Create Button -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Role</h1>
        <a href="/role/create" 
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            + Add Role
        </a>
    </div>

    <!-- Roles Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-xs font-semibold tracking-wide text-left text-white-500 uppercase border-b dark:border-blue-600 bg-blue-50 dark:text-white dark:bg-blue-600">
                      <th class="px-4 py-3">Role Name</th>
                      <th class="px-4 py-3">Code</th>
                      <th class="px-4 py-3">Description</th>
                      <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-white-700 dark:bg-white-800">
                    <template x-for="(role, index) in roles" :key="role.role_id">
                        <tr class="text-black-500 dark:text-black-100">
                            <td class="px-4 py-3 text-sm text-gray-500" x-text="role.role_name"></td>
                            <td class="px-4 py-3 text-sm text-gray-500" x-text="role.code"></td>
                            <td class="px-4 py-3 text-sm text-gray-500" x-text="role.description || '-'"></td>
                            <td class="px-4 py-3 text-xs">
                                <a :href="`/role/${role.role_id}/edit`"
                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button @click="confirmDelete(role.role_id)" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="roles.length === 0">
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No Roles Found</td>
                    </tr>
                    </tbody>
            </table>
        </div>

    </div>
    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this role?</p>
            <div class="flex justify-end space-x-3">
                <button @click="showDeleteModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                <button @click="deleteRole()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/roles/role-script.js') }}">
</script>
@endpush
@endsection