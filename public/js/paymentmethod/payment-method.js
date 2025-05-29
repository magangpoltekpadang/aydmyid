// Jalankan saat DOM sudah dimuat
document.addEventListener('DOMContentLoaded', function () {
    // GraphQL endpoint
    const graphQlEndpoint = '/graphql';

    // Fungsi untuk menjalankan query GraphQL
    async function executeGraphQL(query, variables = {}) {
        try {
            const response = await fetch(graphQlEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    query: query,
                    variables: variables
                })
            });
            return await response.json();
        } catch (error) {
            console.error('GraphQL Error:', error);
            return { errors: [error] };
        }
    }

    // Komponen data Alpine.js untuk jenis kendaraan
    Alpine.data('paymentMethodData', () => ({
        paymentMethods: [],
        pagination: {
            current_page: 1,
            per_page: 10,
            total: 0,
        },
        search: '',
        status: '',
        showDeleteModal: false,
        paymentMethodIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchPaymentMethods();
        },

        async fetchPaymentMethods() {
            this.loading = true;
            this.error = null;

            const query = `
                query GetPaymentMethods($page: Int, $perPage: Int, $search: String, $is_active: Boolean) {
                    paymentMethods(page: $page, perPage: $perPage, search: $search, is_active: $is_active) {
                        data {
                            payment_method_id
                            method_name
                            code
                            is_active
                            created_at
                            updated_at
                        }
                        paginatorInfo {
                            currentPage
                            lastPage
                            perPage
                            total
                            hasMorePages
                        }
                    }
                }
            `;

            const variables = {
                page: this.pagination.current_page,
                perPage: this.pagination.per_page,
                search: this.search,
                is_active: this.status ? this.status === '1' : null
            };

            const result = await executeGraphQL(query, variables);
paymentMethod
            if (result.errors) {
                this.error = result.errors[0].message;
                console.error('GraphQL Errors:', result.errors);
            } else {
                this.paymentMethods = result.data.paymentMethods.data;
                this.pagination = {
                    current_page: result.data.paymentMethods.paginatorInfo.currentPage,
                    last_page: result.data.paymentMethods.paginatorInfo.lastPage,
                    per_page: result.data.paymentMethods.paginatorInfo.perPage,
                    total: result.data.paymentMethods.paginatorInfo.total,
                    has_more: result.data.paymentMethods.paginatorInfo.hasMorePages
                };
            }

            this.loading = false;
        },

        async deletePaymentMethod() {
            if (!this.paymentMethodIdToDelete) return;

            const mutation = `
                mutation DeletePaymentMethod($id: ID!) {
                    deletePaymentMethod(payment_method_id: $id) {
                        payment_method_id
                        method_name
                        code 
                        is_active
                    }
                }
            `;

            const variables = {
                id: this.paymentMethodIdToDelete
            };

            const result = await executeGraphQL(mutation, variables);

            if (result.errors) {
                this.error = result.errors[0].message;
                console.error('GraphQL Errors:', result.errors);
            } else {
                this.showDeleteModal = false;
                await this.fetchPaymentMethods();
            }
        },

        //Pagination methods
        async changePage(page) {
            if (page === '...') return;
            this.pagination.current_page = parsInt(page);
            await this.fetchPaymentMethods();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchPaymentMethods();
            }  
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchPaymentMethods();
            }  
        },

        async resetFilters() {
            this.search = '';  
            this.status = '';  
            this.pagination.current_page = 1;
            await this.fetchPaymentMethods();  
        },

        confirmDelete(id) {
            this.paymentMethodIdToDelete = id;
            this.showDeleteModal = true;
        }

    }));

    //Initialize Alpine
    Alpine.start();
});
