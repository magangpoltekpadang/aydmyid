function serviceData() {
  return {
    services: [],
    serviceTypes: [],
    outlets: [],
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
    showDeleteModal: false,
    showCreateModal: false,
    showEditModal: false,
    serviceIdToDelete: null,
    editedService: {
      service_id: '',
      service_name: '',
      service_type_id: '',
      price: '',
      estimated_duration: '',
      description: '',
      outlet_id: ''
    },

    init() {
      this.fetchServices();
      this.fetchServiceTypes();
      this.fetchOutlets();
    },

    async fetchServices() {
      try {
        const query = `
          query($search: String, $is_active: Boolean) {
            services(search: $search, is_active: $is_active) {
              service_id
              service_name
              service_type_id
              price
              estimated_duration
              description
              outlet_id
              is_active
            }
          }
        `;

        const variables = {
            page: this.pagination.current_page,
            perPage: this.pagination.per_page,
            search: this.search || null,
            is_active: this.status === '' ? null : this.status === '1'
        };

        const response = await fetch('/graphql', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ query, variables })
        });

        const result = await response.json();
        if (result.errors) {
          console.error('GraphQL errors:', result.errors);
          return;
        }

        console.log('Fetched data:', result.data.services);

        this.services = result.data.services || [];

        if (this.status !== '') {
            const isActiveBool = this.status === '1';
            this.services = this.services.filter(v => v.is_active === isActiveBool);
        }

        if (this.search) {
            const lowerSearch = this.search.toLowerCase();
            this.services = this.services.filter(v =>
                v.type_name.toLowerCase().includes(lowerSearch) 
            );
        }

        this.pagination.total = this.services.length;
        this.pagination.last_page = 1;
        this.pagination.from = 1;
        this.pagination.to = this.services.length;
      } catch (error) {
        console.error('Error fetching Services:', error);
      }
    },

    changePage(page) {
      if (page === '...') return;
      this.pagination.current_page = parseInt(page);
      this.fetchServices(page);
    },

    previousPage() {
      if (this.pagination.current_page > 1) {
        this.pagination.current_page--;
        this.fetchServices();
      }
    },

    nextPage() {
      if (this.pagination.current_page < this.pagination.last_page) {
        this.pagination.current_page++;
        this.fetchServices();
      }
    },

    resetFilters() {
      this.search = '';
      this.status = '';
      this.pagination.current_page = 1;
      this.fetchServices();
    },

    async fetchServiceTypes() {
      try {
        const query = `
        query {
          serviceTypes {
            service_type_id
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

      this.serviceTypes = result.data.serviceTypes || [];
      } catch (error) {
        console.error('Error fetching serviceTypes:', error);
      }
    },

    async fetchOutlets() {
      try {
        const query = `
        query {
          outlets {
            outlet_id
            outlet_name
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

      this.outlets = result.data.outlets || [];
      } catch (error) {
        console.error('Error fetching outlets:', error);
      }
    },

    confirmDelete(id) {
      this.serviceIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(service) {
      this.editedService = { ...service };
      this.showEditModal = true;
    },

    async deleteService() {
      try {
        const response = await fetch(`/service/${this.serviceIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchServices();
        }
      } catch (error) {
        console.error('Error deleting Service:', error);
      }
    },

    async updateService() {
      fetch(`/service/${this.editedService.service_id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(this.editedService)
      })
        .then(response => response.json())
        .then(data => {
          this.showEditModal = false;
          this.fetchServices(); // refresh data dari server
        })
        .catch(error => console.log('Error updating Service:', error));
    }
  };
}
