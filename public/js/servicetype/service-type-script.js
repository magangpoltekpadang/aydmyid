function serviceTypeData() {
  return {
    serviceTypes: [],
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
    serviceTypeIdToDelete: null,
    editedServiceType: {
        service_type_id: null,
        type_name: '',
        code: '',
        description: '',
    },
    

    init() {
      this.fetchServiceTypes();
    },

    async fetchServiceTypes() {
            try {
                const query = `
                    query($search: String, $is_active: Boolean) {
                        serviceTypes(search: $search, is_active: $is_active) {
                        service_type_id
                        type_name
                        code
                        description
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
                
                console.log('Fetched data:', result.data.serviceTypes);

                this.serviceTypes = result.data.serviceTypes || [];

                if (this.status !== '') {
                    const isActiveBool = this.status === '1';
                    this.serviceTypes = this.serviceTypes.filter(v => v.is_active === isActiveBool);
                }

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.serviceTypes = this.serviceTypes.filter(v =>
                        v.type_name.toLowerCase().includes(lowerSearch) 
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.serviceTypes.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.serviceTypes.length;
            } catch (error) {
                console.error('Error fetching service types:', error);
            }
        },

    changePage(page) {
      if (page === '...') return;
      this.pagination.current_page = parseInt(page);
      this.fetchServiceTypes(page);
    },

    previousPage() {
      if (this.pagination.current_page > 1) {
        this.pagination.current_page--;
        this.fetchServiceTypes();
      }
    },

    nextPage() {
      if (this.pagination.current_page < this.pagination.last_page) {
        this.pagination.current_page++;
        this.fetchServiceTypes();
      }
    },

    resetFilters() {
      this.search = '';
      this.status = '';
      this.pagination.current_page = 1;
      this.fetchServiceTypes();
    },

    confirmDelete(id) {
      console.log('Deleting ID:', id); // cek apakah ID-nya muncul
      this.serviceTypeIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(serviceType) {
      this.editedServiceType = { ...serviceType };
      this.showEditModal = true;
    },

    async deleteServiceType() {
      try {
        const response = await fetch(`/service-type/${this.serviceTypeIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          this.showCreateModal = false;
          this.showEditModal = false;
          await this.fetchServiceTypes();
        }
      } catch (error) {
        console.error('Error:', error);
      }
    },

    async updateServiceType() {
      fetch(`/service-type/${this.editedServiceType.service_type_id}`, {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.editedServiceType)
      })
      .then(response => response.json())
      .then(data => {
          this.showEditModal = false;
          this.fetchServiceTypes(); // refresh data dari server
      })
      .catch(error => console.log('Error updating service type:', error));
    }
  };
}
