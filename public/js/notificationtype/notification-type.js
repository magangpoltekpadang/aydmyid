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
    Alpine.data('notificationTypeData', () => ({
        notificationTypes: [],
        pagination: {
            current_page: 1,
            per_page: 10,
            total: 0,
        },
        search: '',
        status: '',
        showDeleteModal: false,
        notificationTypeIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchNotificationTypes();
        },

        async fetchNotificationTypes() {
            this.loading = true;
            this.error = null;

            const query = `
                query GetNotificationTypes($page: Int, $perPage: Int, $search: String, $is_active: Boolean) {
                    notificationTypes(page: $page, perPage: $perPage, search: $search, is_active: $is_active) {
                        data {
                            notification_type_id
                            type_name
                            code
                            template_text
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
                this.notificationTypes = result.data.notificationTypes.data;
                this.pagination = {
                    current_page: result.data.notificationTypes.paginatorInfo.currentPage,
                    last_page: result.data.notificationTypes.paginatorInfo.lastPage,
                    per_page: result.data.notificationTypes.paginatorInfo.perPage,
                    total: result.data.notificationTypes.paginatorInfo.total,
                    has_more: result.data.notificationTypes.paginatorInfo.hasMorePages
                };
            }

            this.loading = false;
        },

        async deleteNotificationType() {
            if (!this.notificationTypeIdToDelete) return;

            const mutation = `
                mutation DeleteNotificationType($id: ID!) {
                    deleteNotificationType(notification_type_id: $id) {
                        notification_type_id
                        type_name
                        code 
                        template_text
                        is_active
                    }
                }
            `;

            const variables = {
                id: this.notificationTypeIdToDelete
            };

            const result = await executeGraphQL(mutation, variables);

            if (result.errors) {
                this.error = result.errors[0].message;
                console.error('GraphQL Errors:', result.errors);
            } else {
                this.showDeleteModal = false;
                await this.fetchNotificationTypes();
            }
        },

        //Pagination methods
        async changePage(page) {
            if (page === '...') return;
            this.pagination.current_page = parsInt(page);
            await this.fetchNotificationTypes();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchNotificationTypes();
            }  
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchNotificationTypes();
            }  
        },

        async resetFilters() {
            this.search = '';  
            this.status = '';  
            this.pagination.current_page = 1;
            await this.fetchNotificationTypes();  
        },

        confirmDelete(id) {
            this.notificationTypeIdToDelete = id;
            this.showDeleteModal = true;
        }

    }));

    //Initialize Alpine
    Alpine.start();
});
