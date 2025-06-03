function shiftData() {
  return {
    shifts: [],
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
    shiftIdToDelete: null,
    editedShift: {
      shift_id: '',
      outlet_id: '',
      shift_name: '',
      start_time: '',
      end_time: '',
      is_active: ''
    },

    init() {
      this.fetchShifts();
      this.fetchOutlets();
    },

    async fetchShifts() {
      try {
        const query = `
          query($search: String, $is_active: Boolean) {
            shifts(search: $search, is_active: $is_active) {
              shift_id
              outlet_id
              shift_name
              start_time
              end_time
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
          console.log('GraphQL errors:', result.errors);
          return;
        }

        console.log('Fetched data:', result.data.shifts);

        this.shifts = result.data.shifts || [];

        if (this.status !== '') {
          const isActiveBool = this.status === '1';
          this.shifts = this.shifts.filter(v => v.is_active === isActiveBool);
        }

        if (this.search) {
          const lowerSearch = this.search.toLowerCase();
          this.shifts = this.shifts.filter(v =>
            v.name.toLowerCase().includes(lowerSearch)
          );
        }

        this.pagination.total = this.shifts.length;
        this.pagination.last_page = 1;
        this.pagination.from = 1;
        this.pagination.to = this.shifts.length;
      } catch (error) {
        console.error('Error fetching Shifts:', error);
      }
    },

    changePage(page) {
      if (page === '...') return;
      this.pagination.current_page = parseInt(page);
      this.fetchShifts(page);
    },

    previousPage() {
      if (this.pagination.current_page > 1) {
        this.pagination.current_page--;
        this.fetchShifts();
      }
    },

    nextPage() {
      if (this.pagination.current_page < this.pagination.last_page) {
        this.pagination.current_page++;
        this.fetchShifts();
      }
    },

    resetFilters() {
      this.search = '';
      this.status = '';
      this.pagination.current_page = 1;
      this.fetchShifts();
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
      this.shiftIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(shift) {
      this.editedShift = { ...shift };
      this.showEditModal = true;
    },

    async deleteShift() {
      try {
        const response = await fetch(`/shift/${this.shiftIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchShifts();
        }
      } catch (error) {
        console.error('Error deleting Shift:', error);
      }
    },

    async updateShift() {
      fetch(`/shift/${this.editedShift.shift_id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(this.editedShift)
      })
        .then(response => response.json())
        .then(data => {
          this.showEditModal = false;
          this.fetchShifts(); // refresh data dari server
        })
        .catch(error => console.log('Error updating Shift:', error));
    }
  };
}
