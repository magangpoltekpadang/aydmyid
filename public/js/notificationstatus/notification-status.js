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
    Alpine.data('notificationStatusData', () => ({
        notificationStatuses: [],
        showDeleteModal: false,
        notificationStatusIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchNotificationStatuses();
        },

        async fetchNotificationStatuses() {
            this.loading = true;
            this.error = null;

            const query = `
                query GetNotificationStatuses{
                    notificationStatuses{
                        data {
                            status_id
                            status_name
                            code
                            description
                            created_at
                            updated_at
                        }
                    }
                }
            `;

            const result = await executeGraphQL(query, variables);

            if (result.errors) {
                this.error = result.errors[0].message;
                console.error('GraphQL Errors:', result.errors);
            } else {
                this.notificationStatuses = result.data.notificationStatuses.data;
            }

            this.loading = false;
        },

        async deleteNotificationStatus() {
            if (!this.notificationStatusIdToDelete) return;

            const mutation = `
                mutation DeleteNotificationStatus($id: ID!) {
                    deleteRole(status_id: $id) {
                        status_id
                        status_name
                        code 
                        description
                    }
                }
            `;

            const variables = {
                id: this.notificationStatusIdToDelete
            };

            const result = await executeGraphQL(mutation, variables);

            if (result.errors) {
                this.error = result.errors[0].message;
                console.error('GraphQL Errors:', result.errors);
            } else {
                this.showDeleteModal = false;
                await this.fetchNotificationStatuses();
            }
        },

        confirmDelete(id) {
            this.notificationStatusIdToDelete = id;
            this.showDeleteModal = true;
        }

    }));

    //Initialize Alpine
    Alpine.start();
});
