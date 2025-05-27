function vehicleTypeData() {
  return {
    vehicleTypes: [],
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
    vehicleTypeIdToDelete: null,
    

    init() {
      this.fetchVehicleTypes();
    },

    async fetchVehicleTypes() {
            try {
                const query = `
                    query($search: String, $is_active: Boolean) {
                        vehicleTypes(search: $search, is_active: $is_active) {
                        vehicle_type_id
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
                console.log('Fetched data:', result.data.vehicleTypes);

                this.vehicleTypes = result.data.vehicleTypes || [];

                if (this.status !== '') {
                    const isActiveBool = this.status === '1';
                    this.vehicleTypes = this.vehicleTypes.filter(v => v.is_active === isActiveBool);
                }

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.vehicleTypes = this.vehicleTypes.filter(v =>
                        v.type_name.toLowerCase().includes(lowerSearch) 
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.vehicleTypes.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.vehicleTypes.length;
            } catch (error) {
                console.error('Error fetching vehicle types:', error);
            }
        },

    changePage(page) {
      if (page === '...') return;
      this.pagination.current_page = parseInt(page);
      this.fetchVehicleTypes(page);
    },

    previousPage() {
      if (this.pagination.current_page > 1) {
        this.pagination.current_page--;
        this.fetchVehicleTypes();
      }
    },

    nextPage() {
      if (this.pagination.current_page < this.pagination.last_page) {
        this.pagination.current_page++;
        this.fetchVehicleTypes();
      }
    },

    resetFilters() {
      this.search = '';
      this.status = '';
      this.pagination.current_page = 1;
      this.fetchVehicleTypes();
    },

    confirmDelete(id) {
      console.log('Deleting ID:', id); // cek apakah ID-nya muncul
      this.vehicleTypeIdToDelete = id;
      this.showDeleteModal = true;
    },

    async deleteVehicleType() {
      try {
        const response = await fetch(`/vehicle-type/${this.vehicleTypeIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchVehicleTypes();
        }
      } catch (error) {
        console.error('Error:', error);
      }
    }
  };
}
