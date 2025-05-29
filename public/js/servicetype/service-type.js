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
    Alpine.data('serviceTypeData', () => ({
        serviceTypes: [],
        pagination: {
            current_page: 1,
            per_page: 10,
            total: 0,
        },
        search: '',
        status: '',
        showDeleteModal: false,
        serviceTypeIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchServiceTypes();
        },

        async fetchServiceTypes() {
            this.loading = true;
            this.error = null;

            const query = `
                query GetServiceTypes($page: Int, $perPage: Int, $search: String, $is_active: Boolean) {
                    serviceTypes(page: $page, perPage: $perPage, search: $search, is_active: $is_active) {
                        data {
                            service_type_id
                            type_name
                            code
                            description
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

            if (result.errors) {
                this.error = result.errors[0].message;
                console.error('GraphQL Errors:', result.errors);
            } else {
                this.serviceTypes = result.data.serviceTypes.data;
                this.pagination = {
                    current_page: result.data.serviceTypes.paginatorInfo.currentPage,
                    last_page: result.data.serviceTypes.paginatorInfo.lastPage,
                    per_page: result.data.serviceTypes.paginatorInfo.perPage,
                    total: result.data.serviceTypes.paginatorInfo.total,
                    has_more: result.data.serviceTypes.paginatorInfo.hasMorePages
                };
            }

            this.loading = false;
        },

        async deleteServiceType() {
            if (!this.serviceTypeIdToDelete) return;

            const mutation = `
                mutation DeleteServiceType($id: ID!) {
                    deleteServiceType(service_type_id: $id) {
                        service_type_id
                        type_name
                        code 
                        description
                        is_active
                    }
                }
            `;

            const variables = {
                id: this.serviceTypeIdToDelete
            };

            const result = await executeGraphQL(mutation, variables);

            if (result.errors) {
                this.error = result.errors[0].message;
                console.error('GraphQL Errors:', result.errors);
            } else {
                this.showDeleteModal = false;
                await this.fetchServiceTypes();
            }
        },

        //Pagination methods
        async changePage(page) {
            if (page === '...') return;
            this.pagination.current_page = parsInt(page);
            await this.fetchServiceTypes();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchServiceTypes();
            }  
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchServiceTypes();
            }  
        },

        async resetFilters() {
            this.search = '';  
            this.status = '';  
            this.pagination.current_page = 1;
            await this.fetchServiceTypes();  
        },

        confirmDelete(id) {
            this.serviceTypeIdToDelete = id;
            this.showDeleteModal = true;
        }

    }));

    //Initialize Alpine
    Alpine.start();
});
