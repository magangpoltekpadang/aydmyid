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
    Alpine.data('paymentStatusData', () => ({
        paymentStatuses: [],
        showDeleteModal: false,
        paymentStatusIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchPaymentStatuses();
        },

        async fetchPaymentStatuses() {
            this.loading = true;
            this.error = null;

            const query = `
                query GetPaymentStatuses{
                    paymentStatuses{
                        data {
                            payment_status_id
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
                this.paymentStatuses = result.data.paymentStatuses.data;
            }

            this.loading = false;
        },

        async deletePaymentStatus() {
            if (!this.paymentStatusIdToDelete) return;

            const mutation = `
                mutation DeletePaymentStatus($id: ID!) {
                    deleteRole(payment_status_id: $id) {
                        payment_status_id
                        status_name
                        code 
                        description
                    }
                }
            `;

            const variables = {
                id: this.paymentStatusIdToDelete
            };

            const result = await executeGraphQL(mutation, variables);

            if (result.errors) {
                this.error = result.errors[0].message;
                console.error('GraphQL Errors:', result.errors);
            } else {
                this.showDeleteModal = false;
                await this.fetchPaymentStatuses();
            }
        },

        confirmDelete(id) {
            this.paymentStatusIdToDelete = id;
            this.showDeleteModal = true;
        }

    }));

    //Initialize Alpine
    Alpine.start();
});
