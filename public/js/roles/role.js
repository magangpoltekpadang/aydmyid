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
    Alpine.data('roleData', () => ({
        roles: [],
        showDeleteModal: false,
        roleIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchRoles();
        },

        async fetchRoles() {
            this.loading = true;
            this.error = null;

            const query = `
                query GetRoles{
                    roles{
                        data {
                            role_id
                            role_name
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
                this.roles = result.data.roles.data;
            }

            this.loading = false;
        },

        async deleteRole() {
            if (!this.roleIdToDelete) return;

            const mutation = `
                mutation DeleteRole($id: ID!) {
                    deleteRole(role_id: $id) {
                        role_id
                        role_name
                        code 
                        description
                    }
                }
            `;

            const variables = {
                id: this.roleIdToDelete
            };

            const result = await executeGraphQL(mutation, variables);

            if (result.errors) {
                this.error = result.errors[0].message;
                console.error('GraphQL Errors:', result.errors);
            } else {
                this.showDeleteModal = false;
                await this.fetchRoles();
            }
        },

        confirmDelete(id) {
            this.roleIdToDelete = id;
            this.showDeleteModal = true;
        }

    }));

    //Initialize Alpine
    Alpine.start();
});
