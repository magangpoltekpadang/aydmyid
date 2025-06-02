function staffData() {
  return {
    staffs: [],
    outlets: [],
    roles: [],
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
    staffIdToDelete: null,
    editedStaff: {
      staff_id: '',
      name: '',
      email: '',
      phone_number: '',
      password_hash: '',
      outlet_id: '',
      role_id: ''
    },

    init() {
      this.fetchStaffs();
      this.fetchOutlets();
      this.fetchRoles();
    },

    async fetchStaffs() {
      try {
        const query = `
          query($search: String, $is_active: Boolean) {
            staffs(search: $search, is_active: $is_active) {
              staff_id
              name
              email
              phone_number
              password_hash
              outlet_id
              role_id
              last_login
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

        console.log('Fetched data:', result.data.staffs);

        this.staffs = result.data.staffs || [];

        if (this.status !== '') {
            const isActiveBool = this.status === '1';
            this.staffs = this.staffs.filter(v => v.is_active === isActiveBool);
        }

        if (this.search) {
            const lowerSearch = this.search.toLowerCase();
            this.staffs = this.staffs.filter(v =>
                v.name.toLowerCase().includes(lowerSearch) 
            );
        }

        this.pagination.total = this.staffs.length;
        this.pagination.last_page = 1;
        this.pagination.from = 1;
        this.pagination.to = this.staffs.length;
      } catch (error) {
        console.error('Error fetching Staffs:', error);
      }
    },

    changePage(page) {
      if (page === '...') return;
      this.pagination.current_page = parseInt(page);
      this.fetchStaffs(page);
    },

    previousPage() {
      if (this.pagination.current_page > 1) {
        this.pagination.current_page--;
        this.fetchStaffs();
      }
    },

    nextPage() {
      if (this.pagination.current_page < this.pagination.last_page) {
        this.pagination.current_page++;
        this.fetchStaffs();
      }
    },

    resetFilters() {
      this.search = '';
      this.status = '';
      this.pagination.current_page = 1;
      this.fetchStaffs();
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

    async fetchRoles() {
      try {
        const query = `
        query {
          roles {
            role_id
            role_name
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

      this.roles = result.data.roles || [];
      } catch (error) {
        console.error('Error fetching roles:', error);
      }
    },

    confirmDelete(id) {
      this.staffIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(staff) {
      this.editedStaff = { ...staff };
      this.showEditModal = true;
    },

    async deleteStaff() {
      try {
        const response = await fetch(`/staff/${this.staffIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchStaffs();
        }
      } catch (error) {
        console.error('Error deleting Staff:', error);
      }
    },

    async updateStaff() {
      fetch(`/staff/${this.editedStaff.staff_id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(this.editedStaff)
      })
        .then(response => response.json())
        .then(data => {
          this.showEditModal = false;
          this.fetchStaffs(); // refresh data dari server
        })
        .catch(error => console.log('Error updating Staff:', error));
    }
  };
}
