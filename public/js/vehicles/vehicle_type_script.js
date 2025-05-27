function vehicleTypeData() {
  return {
    vehicleTypes: [],
    pagination: {
      current_page: 1,
      last_page: 1,
      per_page: 0,
      total: 0,
      from: 0,
      to: 0,
      links: []
    },
    search: '',
    status: '',
    showDeleteModal: false,
    vehicleTypeIdToDelete: null,

    init() {
      this.fetchVehicleTypes();
    },

    async fetchVehicleTypes() {
      try {
        const params = new URLSearchParams({
          page: this.pagination.current_page,
          search: this.search,
          is_active: this.status,
        });

        const response = await fetch(`/api/vehicle-types?${params}`);
        const data = await response.json();

        this.vehicleTypes = data.data;
        this.pagination = {
          current_page: data.current_page,
          last_page: data.last_page,
          per_page: data.per_page,
          total: data.total,
          from: data.from,
          to: data.to,
          links: data.links.filter(link =>
            link.label !== '&laquo; Previous' &&
            link.label !== 'Next &raquo;'
          )
        };
      } catch (error) {
        console.error('Error:', error);
      }
    },

    changePage(page) {
      if (page === '...') return;
      this.pagination.current_page = parseInt(page);
      this.fetchVehicleTypes();
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
      this.vehicleTypeIdToDelete = id;
      this.showDeleteModal = true;
    },

    async deleteVehicleType() {
      try {
        const response = await fetch(`/api/vehicle-types/${this.vehicleTypeIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
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
