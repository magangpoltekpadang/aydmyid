function notificationData() {
  return {
    notifications: [],
    showDeleteModal: false,
    showCreateModal: false,
    showEditModal: false,
    notificationIdToDelete: null,
    editedNotification: {
        notifications_id: null,
        customer_id: null,
        notification_type_id: null,
        message: '',
        sent_at: '',
        status_id: null,
        retry_count: '',
    },

    init() {
      this.fetchNotifications();
    },

    async fetchNotifications() {
      try {
        const query = `
          query {
            notifications{
              notifications_id
              customer_id
              notification_type_id
              message
              sent_at
              status_id
              retry_count
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
        
        console.log('Fetched data:', result.data.notifications);
        
        this.notifications = result.data.notifications || [];
      
      } catch (error) {
        console.error('Error fetching Notifications:', error);
      }
    },

    confirmDelete(id) {
      this.notificationIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(notification) {
      this.editedNotification = { ...notification };
      this.showEditModal = true;
    },

    async deleteNotification() {
      try {
        const response = await fetch(`/notification/${this.notificationIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchNotifications();
        }
      } catch (error) {
        console.error('Error deleting Notification:', error);
      }
    },

    async updateNotification() {
      fetch(`/notification/${this.editedNotification.notification_id}`, {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.editedNotification)
      })
      .then(response => response.json())
      .then(data => {
          this.showEditModal = false;
          this.fetchNotifications(); // refresh data dari server
      })
      .catch(error => console.log('Error updating Notification:', error));
    }
  };
}
