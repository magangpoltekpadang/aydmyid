function notificationStatusData() {
  return {
    notificationStatuses: [],
    showDeleteModal: false,
    showCreateModal: false,
    showEditModal: false,
    notificationStatusIdToDelete: null,
    editedNotificationStatus: {
        status_id: null,
        status_name: '',
        code: '',
        description: '',
    },

    init() {
      this.fetchNotificationStatuses();
    },

    async fetchNotificationStatuses() {
      try {
        const query = `
          query {
            notificationStatuses{
              status_id
              status_name
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
        
        console.log('Fetched data:', result.data.notificationStatuses);
        
        this.notificationStatuses = result.data.notificationStatuses || [];
      
      } catch (error) {
        console.error('Error fetching Notification Status:', error);
      }
    },

    confirmDelete(id) {
      this.notificationStatusIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(notificationStatus) {
      this.editedNotificationStatus = { ...notificationStatus };
      this.showEditModal = true;
    },

    async deleteNotificationStatus() {
      try {
        const response = await fetch(`/notification-status/${this.notificationStatusIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchNotificationStatuses();
        }
      } catch (error) {
        console.error('Error deleting Notification Status:', error);
      }
    },

    async updateNotificationStatus() {
      fetch(`/notification-status/${this.editedNotificationStatus.status_id}`, {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.editedNotificationStatus)
      })
      .then(response => response.json())
      .then(data => {
          this.showEditModal = false;
          this.fetchNotificationStatuses(); // refresh data dari server
      })
      .catch(error => console.log('Error updating notification status:', error));
    }
  };
}
