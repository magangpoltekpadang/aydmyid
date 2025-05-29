@extends('layout.main')

@section('content')
<div x-data="{ ...membershipPackageData(), showCreateModal: false, showEditModal: false}" class="space-y-6">
    <!-- Header and Create Button -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Membership Package</h1>
        <button @click="showCreateModal = true;"
                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                + Add Package
            </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Total Membership Package -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-white-800">
            <div class="w-12 h-12 mr-4 flex items-center justify-center text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
                <i class="fas fa-box text-xl"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-700">Total Packages</p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-600"
                    x-text="pagination.total">
                </p>
            </div>
        </div>

        <!-- Active Packages -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-white-800">
            <div class="w-12 h-12 mr-4 flex items-center justify-center text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <i class="fas fa-check-circle text-xl"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-700">Active Packages</p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-600"
                    x-text="membershipPackages.filter(v => v.is_active).length">
                </p>
            </div>
        </div>

        <!-- Inactive Packages -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-white-800">
            <div class="w-12 h-12 mr-4 flex items-center justify-center text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                <i class="fas fa-times-circle text-xl"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-700">Inactive Packages</p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-600"
                    x-text="membershipPackages.filter(v => !v.is_active).length">
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
                <input type="text" id="search" x-model="search" placeholder="Type to search..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" x-model="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    <option value="">All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <div class ="flex items-end">
                <button @click="fetchMembershipPackage()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                <button @click="resetFilters()" class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    <i class="fas fa-times mr-2"></i> Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Membership Package Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-white-500 uppercase border-b dark:border-purple-600 bg-purple-50 dark:text-white dark:bg-purple-600">
                        <th class="px-4 py-3">Package Name</th>
                        <th class="px-4 py-3">Duration Days</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Max Vehicles</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-white-700 dark:bg-white-800">
                    <template x-for="(membershipPackage, index) in membershipPackages" :key="membershipPackage.package_id">
                        <tr class="text-black-500 dark:text-black-100">
                            <td class="px-4 py-3 text-sm text-gray-500" x-text="membershipPackage.package_name"></td>
                            <td class="px-4 py-3 text-sm text-gray-500" x-text="membershipPackage.duration_days"></td>
                            <td class="px-4 py-3 text-sm text-gray-500" x-text="membershipPackage.price"></td>
                            <td class="px-4 py-3 text-sm text-gray-500" x-text="membershipPackage.max_vehicles"></td>
                            <td class="px-4 py-3 text-sm text-gray-500" x-text="membershipPackage.description || '-'"></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span x-bind:class="membershipPackage.is_active ? 'bg-green-600 text-green-100' : 'bg-red-600 text-red-100'"
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    x-text="membershipPackage.is_active ? 'Active' : 'Inactive'">
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                 <button @click="startEdit(membershipPackage)" class="text-purple-600 hover:text-purple-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                <button @click="confirmDelete(membershipPackage.package_id)" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="membershipPackages.length === 0">
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No Membership Package Found</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" x-show="pagination.last_page > 1">
            <div x-data class="flex-1 flex justify-between sm:hidden">
                <button x-show="pagination.current_page > 1" @click="previousPage()" :disabled="pagination.current_page === 1"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Previous
                </button>
                <button x-show="pagination.current_page < pagination.last_page" @click="nextPage()" :disabled="pagination.current_page === pagination.last_page"
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
                                    :class="page.active ? 'z-10 bg-purple-50 border-purple-500 text-purple-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'"
                                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                    x-text="page.label">
                            </button>
                        </template>


                        <button @click="nextPage()" :disabled="pagination.current_page === pagination.last_page"
                                class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <i class="fas fa-angle-right"></i>
                        </button>
                        <button @click="changePage(pagination.last_page)" :disabled="pagination.current_page === pagination.last_page"
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
    <div x-show="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this package?</p>
            <div class="flex justify-end space-x-3">
                <button @click="showDeleteModal = false" 
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                <button @click="deleteMembershipPackage()" 
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>

    <!-- Modal Create-->
    <div x-show="showCreateModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
        <div @click.away="showCreateModal = false" class="bg-white rounded-lg shadow w-full max-w-md mx-4">
            @include('MembershipPackage.create') {{-- Memanggil form dari file create.blade.php --}}
        </div>
    </div>

    <!-- Modal Create-->
    <div x-show="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
        <div @click.away="showEditModal = false" class="bg-white rounded-lg shadow w-full max-w-md mx-4">
            @include('MembershipPackage.edit') {{-- Memanggil form dari file edit.blade.php --}}
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/membershippackage/membership-package-script.js') }}">
</script>
@endpush
@endsection