function customerData() {
  return {
    customers: [],
    search: '',
    status: '',
    pagination: {
      current_page: 1,
      last_page: 1,
      per_page: 0,
      total: 0,
      from: 0,
      to: 0,
      links: []
    },
    vehicleTypes: [],
    showDeleteModal: false,
    showCreateModal: false,
    showEditModal: false,
    customerIdToDelete: null,
    editedCustomer: {
      plate_number: '',
      name: '',
      phone_number: '',
      vehicle_type_id: '',
      vehicle_color: '',
      member_number: '',
      join_date: '',
      member_expiry_date: '',
    },

    init() {
      this.fetchCustomers();
      this.fetchVehicleTypes();
    },

    async fetchCustomers() {
      try {
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
            }
          }
        `;

        const variables = {
            page: this.pagination.current_page,
            perPage: this.pagination.per_page,
            search: this.search || null,
            is_member: this.status === '' ? null : this.status === '1'
        };

        const response = await fetch('/graphql', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ query, variables  })
        });

        const result = await response.json();
        if (result.errors) {
          console.error('GraphQL errors:', result.errors);
          return;
        }

        console.log('Fetched data:', result.data.customers);

        this.customers = result.data.customers || [];

        if (this.status !== '') {
          const isActiveBool = this.status === '1';
          this.customers = this.customers.filter(v => v.is_member === isActiveBool);
        }

        if (this.search) {
            const lowerSearch = this.search.toLowerCase();
            this.customers = this.customers.filter(v =>
                v.name.toLowerCase().includes(lowerSearch) 
            );
        }

        this.pagination.total = this.customers.length;
        this.pagination.last_page = 1;
        this.pagination.from = 1;
        this.pagination.to = this.customers.length;
      } catch (error) {
        console.error('Error fetching Customers:', error);
      }
    },

    async fetchVehicleTypes() {
      try {
        const query = `
        query {
          vehicleTypes {
            vehicle_type_id
            type_name
          }
        }
      `;

        const response = await fetch('/graphql', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ query })
        });

        const result = await response.json();
        if (result.errors) {
          console.error('GraphQL errors:', result.errors);
          return;
        }

        this.vehicleTypes = result.data.vehicleTypes || [];
      } catch (error) {
        console.error('Error fetching vehicle types:', error);
      }
    },

    confirmDelete(id) {
      this.customerIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(customer) {
      this.editedCustomer = { ...customer };
      this.showEditModal = true;
    },

    async deleteCustomer() {
      try {
        const response = await fetch(`/customer/${this.customerIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchCustomers();
        }
      } catch (error) {
        console.error('Error deleting Customer:', error);
      }
    },

    async updateCustomer() {
      fetch(`/customer/${this.editedCustomer.customer_id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(this.editedCustomer)
      })
        .then(response => response.json())
        .then(data => {
          this.showEditModal = false;
          this.fetchCustomers(); // refresh data dari server
        })
        .catch(error => console.log('Error updating Customer:', error));
    }
  };
}
