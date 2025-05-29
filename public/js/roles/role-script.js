function roleData() {
  return {
    roles: [],
    showDeleteModal: false,
    showCreateModal: false,
    showEditModal: false,
    roleIdToDelete: null,
    editedRole: {
        role_id: null,
        role_name: '',
        code: '',
        description: '',
    },

    init() {
      this.fetchRoles();
    },

    async fetchRoles() {
      try {
        const query = `
          query {
            roles{
              role_id
              role_name
              code
              description
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
        
        console.log('Fetched data:', result.data.roles);
        
        this.roles = result.data.roles || [];
      
      } catch (error) {
        console.error('Error fetching Roles:', error);
      }
    },

    confirmDelete(id) {
      this.roleIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(role) {
      this.editedRole = { ...role };
      this.showEditModal = true;
    },

    async deleteRole() {
      try {
        const response = await fetch(`/role/${this.roleIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchRoles();
        }
      } catch (error) {
        console.error('Error deleting Role:', error);
      }
    },

    async updateRole() {
      fetch(`/role/${this.editedRole.role_id}`, {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.editedRole)
      })
      .then(response => response.json())
      .then(data => {
          this.showEditModal = false;
          this.fetchRoles(); // refresh data dari server
      })
      .catch(error => console.log('Error updating role:', error));
    }
  };
}
