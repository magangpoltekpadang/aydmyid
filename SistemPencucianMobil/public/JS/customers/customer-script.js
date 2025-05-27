function customerData() {
    return {
        customers: [],
        search: '',
        is_member: null, // filter anggota atau tidak, null artinya semua
        loading: false,
        error: null,

        init() {
            this.fetchCustomers();
        },

        async fetchCustomers() {
            this.loading = true;
            this.error = null;

            const query = `
                query($search: String, $is_member: Boolean) {
                    customers(search: $search, is_member: $is_member) {
                        customer_id
                        plate_number
                        name
                        phone_number
                        vehicle_type_id
                        vehicle_color
                        member_number
                        join_date
                        member_expiry_date
                        is_member
                        created_at
                        updated_at
                    }
                }
            `;

            const variables = {};
            if (this.search.trim() !== '') variables.search = this.search;
            if (this.is_member !== null) variables.is_member = this.is_member;

            try {
                const response = await fetch('/graphql', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ query, variables }),
                });

                const result = await response.json();

                if (result.errors) {
                    this.error = result.errors[0].message;
                    console.error('GraphQL Error:', result.errors);
                    this.customers = [];
                } else {
                    this.customers = result.data.customers || [];
                }
            } catch (error) {
                this.error = error.message || 'Error fetching customers';
                this.customers = [];
                console.error('Fetch Error:', error);
            }

            this.loading = false;
        },

        async resetFilters() {
            this.search = '';
            this.is_member = null;
            await this.fetchCustomers();
        },

        async filterMembers(value) {
            this.is_member = value;
            await this.fetchCustomers();
        },
    }
}
