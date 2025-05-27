function roleData() {
  return {
    roles: [],
    showDeleteModal: false,
    roleIdToDelete: null,

    init() {
      this.fetchRoles();
    },

    async fetchRoles() {
      try {
        const query = `
          query {
            roles {
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
    }
  };
}
