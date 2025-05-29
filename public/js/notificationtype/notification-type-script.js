function notificationTypeData() {
  return {
    notificationTypes: [],
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
    notificationTypeIdToDelete: null,
    editedNotificationType: {
        notification_type_id: null,
        type_name: '',
        code: '',
        template_text: '',
    },
    

    init() {
      this.fetchNotificationTypes();
    },

    async fetchNotificationTypes() {
            try {
                const query = `
                    query($search: String, $is_active: Boolean) {
                        notificationTypes(search: $search, is_active: $is_active) {
                        notification_type_id
                        type_name
                        code
                        template_text
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
                
                console.log('Fetched data:', result.data.notificationTypes);

                this.notificationTypes = result.data.notificationTypes || [];

                if (this.status !== '') {
                    const isActiveBool = this.status === '1';
                    this.notificationTypes = this.notificationTypes.filter(v => v.is_active === isActiveBool);
                }

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.notificationTypes = this.notificationTypes.filter(v =>
                        v.type_name.toLowerCase().includes(lowerSearch) 
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.notificationTypes.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.notificationTypes.length;
            } catch (error) {
                console.error('Error fetching Notification types:', error);
            }
        },

    changePage(page) {
      if (page === '...') return;
      this.pagination.current_page = parseInt(page);
      this.fetchNotificationTypes(page);
    },

    previousPage() {
      if (this.pagination.current_page > 1) {
        this.pagination.current_page--;
        this.fetchNotificationTypes();
      }
    },

    nextPage() {
      if (this.pagination.current_page < this.pagination.last_page) {
        this.pagination.current_page++;
        this.fetchNotificationTypes();
      }
    },

    resetFilters() {
      this.search = '';
      this.status = '';
      this.pagination.current_page = 1;
      this.fetchNotificationTypes();
    },

    confirmDelete(id) {
      console.log('Deleting ID:', id); // cek apakah ID-nya muncul
      this.notificationTypeIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(notificationType) {
      this.editedNotificationType = { ...notificationType };
      this.showEditModal = true;
    },

    async deleteNotificationType() {
      try {
        const response = await fetch(`/notification-type/${this.notificationTypeIdToDelete}`, {
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
          await this.fetchNotificationTypes();
        }
      } catch (error) {
        console.error('Error:', error);
      }
    },

    async updateNotificationType() {
      fetch(`/notification-type/${this.editedNotificationType.notification_type_id}`, {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.editedNotificationType)
      })
      .then(response => response.json())
      .then(data => {
          this.showEditModal = false;
          this.fetchNotificationTypes(); // refresh data dari server
      })
      .catch(error => console.log('Error updating notification type:', error));
    }
  };
}
