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
    Alpine.data('membershipPackageData', () => ({
        membershipPackages: [],
        pagination: {
            current_page: 1,
            per_page: 10,
            total: 0,
        },
        search: '',
        status: '',
        showDeleteModal: false,
        membershipPackageIdToDelete: null,
        loading: false,
        error: null,

        async init() {
            await this.fetchMembershipPackages();
        },

        async fetchMembershipPackages() {
            this.loading = true;
            this.error = null;

            const query = `
                query GetMembershipPackages($page: Int, $perPage: Int, $search: String, $is_active: Boolean) {
                    membershipPackages(page: $page, perPage: $perPage, search: $search, is_active: $is_active) {
                        data {
                            package_id
                            package_name
                            duration_days
                            price
                            max_vehicles
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
                this.membershipPackages = result.data.membershipPackages.data;
                this.pagination = {
                    current_page: result.data.membershipPackages.paginatorInfo.currentPage,
                    last_page: result.data.membershipPackages.paginatorInfo.lastPage,
                    per_page: result.data.membershipPackages.paginatorInfo.perPage,
                    total: result.data.membershipPackages.paginatorInfo.total,
                    has_more: result.data.membershipPackages.paginatorInfo.hasMorePages
                };
            }

            this.loading = false;
        },

        async deleteMembershipPackage() {
            if (!this.membershipPackagesIdToDelete) return;

            const mutation = `
                mutation DeleteMembershipPackage($id: ID!) {
                    deleteMembershipPackage(package_id: $id) {
                        package_id
                        package_name
                        duration_days
                        price
                        max_vehicles
                        description
                        is_active
                    }
                }
            `;

            const variables = {
                id: this.membershipPackageIdToDelete
            };

            const result = await executeGraphQL(mutation, variables);

            if (result.errors) {
                this.error = result.errors[0].message;
                console.error('GraphQL Errors:', result.errors);
            } else {
                this.showDeleteModal = false;
                await this.fetchMembershipPackages();
            }
        },

        //Pagination methods
        async changePage(page) {
            if (page === '...') return;
            this.pagination.current_page = parsInt(page);
            await this.fetchMembershipPackages();
        },

        async previousPage() {
            if (this.pagination.current_page > 1) {
                this.pagination.current_page--;
                await this.fetchMembershipPackages();
            }  
        },

        async nextPage() {
            if (this.pagination.current_page < this.pagination.last_page) {
                this.pagination.current_page++;
                await this.fetchMembershipPackages();
            }  
        },

        async resetFilters() {
            this.search = '';  
            this.status = '';  
            this.pagination.current_page = 1;
            await this.fetchMembershipPackages();  
        },

        confirmDelete(id) {
            this.membershipPackageIdToDelete = id;
            this.showDeleteModal = true;
        }

    }));

    //Initialize Alpine
    Alpine.start();
});
