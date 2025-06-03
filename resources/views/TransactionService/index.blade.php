@extends('layout.main')

@section('content')
    <div x-data="{ ...transactionServiceData(), showCreateModal: false, showEditModal: false }" class="space-y-6">
        <!-- Header and Create Button -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Transaction Service</h1>
            <button @click="showCreateModal = true;"
                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                + Add Transaction Service
            </button>
        </div>

        <!-- table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-white-500 uppercase border-b dark:border-purple-600 bg-purple-50 dark:text-white dark:bg-purple-600">
                            <th class="px-4 py-3">Transaction Id</th>
                            <th class="px-4 py-3">Service Id</th>
                            <th class="px-4 py-3">Quantity</th>
                            <th class="px-4 py-3">Unit Price</th>
                            <th class="px-4 py-3">Discount</th>
                            <th class="px-4 py-3">Total Price</th>
                            <th class="px-4 py-3">Worker Id</th>
                            <th class="px-4 py-3">Start Time</th>
                            <th class="px-4 py-3">End Time</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Notes</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-white-700 dark:bg-white-800">
                        <template x-for="(transactionService, index) in transactionServices" :key="transactionService.transaction_service_id">
                            <tr class="text-black-500 dark:text-black-100">
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="transactionService.transaction_id"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="transactionService.service_id"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="transactionService.quantity"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="transactionService.unit_price"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="transactionService.discount"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="transactionService.total_price"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="transactionService.worker_id"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="transactionService.start_time"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="transactionService.end_time"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="transactionService.status"></td>
                                <td class="px-4 py-3 text-sm text-gray-500" x-text="transactionService.notes"></td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    <button @click="startEdit(transactionService)" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="confirmDelete(transactionService.transaction_service_id)"
                                        class="text-red-500 hover:text-red-500">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="transactionServices.length === 0">
                            <td colspan="12" class="px-6 py-4 text-center text-sm text-gray-500">No Transaction Service Found
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this transaction service?</p>
                <div class="flex justify-end space-x-3">
                    <button @click="showDeleteModal = false"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                    <button @click="deleteTransactionService()"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>

        <!-- Modal Create-->
        <div x-show="showCreateModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
            <div @click.away="showCreateModal = false" class="bg-white rounded-lg shadow w-full max-w-md mx-4">
                @include('TransactionService.create') {{-- Memanggil form dari file create.blade.php --}}
            </div>
        </div>

        <!-- Modal Edit-->
        <div x-show="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
            <div @click.away="showEditModal = false" class="bg-white rounded-lg shadow w-full max-w-md mx-4">
                @include('TransactionService.edit') {{-- Memanggil form dari file edit.blade.php --}}
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/transactionservice/transaction-service-script.js') }}"></script>
    @endpush
@endsection
