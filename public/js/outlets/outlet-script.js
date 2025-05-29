function outletData() {
  return {
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
    outletIdToDelete: null,
    editedOutlet: {
        outlet_id: null,
        outlet_name: '',
        phone_number: '',
        latitude: '',
        longitude: '',
    },
    

    init() {
      this.fetchOutlets();
    },

    async fetchOutlets() {
            try {
                const query = `
                    query($search: String, $is_active: Boolean) {
                        outlets(search: $search, is_active: $is_active) {
                        outlet_id
                        outlet_name
                        address
                        phone_number
                        latitude
                        longitude
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
                
                console.log('Fetched data:', result.data.outlets);

                this.outlets = result.data.outlets || [];

                if (this.status !== '') {
                    const isActiveBool = this.status === '1';
                    this.outlets = this.outlets.filter(v => v.is_active === isActiveBool);
                }

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.outlets = this.outlets.filter(v =>
                        v.outlet_name.toLowerCase().includes(lowerSearch) 
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.outlets.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.outlets.length;
            } catch (error) {
                console.error('Error fetching outlets:', error);
            }
        },

    changePage(page) {
      if (page === '...') return;
      this.pagination.current_page = parseInt(page);
      this.fetchOutlets(page);
    },

    previousPage() {
      if (this.pagination.current_page > 1) {
        this.pagination.current_page--;
        this.fetchOutlets();
      }
    },

    nextPage() {
      if (this.pagination.current_page < this.pagination.last_page) {
        this.pagination.current_page++;
        this.fetchOutlets();
      }
    },

    resetFilters() {
      this.search = '';
      this.status = '';
      this.pagination.current_page = 1;
      this.fetchOutlets();
    },

    confirmDelete(id) {
      console.log('Deleting ID:', id); // cek apakah ID-nya muncul
      this.outletIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(outlet) {
      this.editedOutlet = { ...outlet };
      this.showEditModal = true;
    },

    async deleteOutlet() {
      try {
        const response = await fetch(`/outlet/${this.outletIdToDelete}`, {
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
          await this.fetchOutlets();
        }
      } catch (error) {
        console.error('Error deleting Outlet:', error);
      }
    },

    async updateOutlet() {
      fetch(`/outlet/${this.editedOutlet.outlet_id}`, {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.editedOutlet)
      })
      .then(response => response.json())
      .then(data => {
          this.showEditModal = false;
          this.fetchOutlets(); // refresh data dari server
      })
      .catch(error => console.log('Error updating outlet:', error));
    }
  };
}
