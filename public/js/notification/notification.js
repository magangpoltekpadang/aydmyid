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
    Alpine.data('notificationData', () => ({
        notifications: [],
        showDeleteModal: false,
        notificationIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchNotifications();
        },

        async fetchNotifications() {
            this.loading = true;
            this.error = null;

            const query = `
                query GetNotifications{
                    notifications{
                        data {
                            notifications_id
                            customer_id
                            notification_type_id
                            message
                            sent_at
                            status_id
                            retry_count
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
                this.notifications = result.data.notifications.data;
            }

            this.loading = false;
        },

        async deleteNotification() {
            if (!this.notificationIdToDelete) return;

            const mutation = `
                mutation DeleteNotification($id: ID!) {
                    deleteNotification(notifications_id: $id) {
                        notifications_id
                        customer_id
                        notification_type_id
                        message
                        sent_at
                        status_id
                        retry_count
                    }
                }
            `;

            const variables = {
                id: this.notificationIdToDelete
            };

            const result = await executeGraphQL(mutation, variables);

            if (result.errors) {
                this.error = result.errors[0].message;
                console.error('GraphQL Errors:', result.errors);
            } else {
                this.showDeleteModal = false;
                await this.fetchNotifications();
            }
        },

        confirmDelete(id) {
            this.notificationIdToDelete = id;
            this.showDeleteModal = true;
        }

    }));

    //Initialize Alpine
    Alpine.start();
});
