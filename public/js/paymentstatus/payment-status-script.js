function paymentStatusData() {
  return {
    paymentStatuses: [],
    showDeleteModal: false,
    showCreateModal: false,
    showEditModal: false,
    paymentStatusIdToDelete: null,
    editedPaymentStatus: {
        payment_status_id: null,
        status_name: '',
        code: '',
        description: '',
    },

    init() {
      this.fetchPaymentStatuses();
    },

    async fetchPaymentStatuses() {
      try {
        const query = `
          query {
            paymentStatuses{
              payment_status_id
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
        
        console.log('Fetched data:', result.data.paymentStatuses);
        
        this.paymentStatuses = result.data.paymentStatuses || [];
      
      } catch (error) {
        console.error('Error fetching Payment Status:', error);
      }
    },

    confirmDelete(id) {
      this.paymentStatusIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(paymentStatus) {
      this.editedPaymentStatus = { ...paymentStatus };
      this.showEditModal = true;
    },

    async deletePaymentStatus() {
      try {
        const response = await fetch(`/payment-status/${this.paymentStatusIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchPaymentStatuses();
        }
      } catch (error) {
        console.error('Error deleting Payment Status:', error);
      }
    },

    async updatePaymentStatus() {
      fetch(`/payment-status/${this.editedPaymentStatus.payment_status_id}`, {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.editedPaymentStatus)
      })
      .then(response => response.json())
      .then(data => {
          this.showEditModal = false;
          this.fetchPaymentStatuses(); // refresh data dari server
      })
      .catch(error => console.log('Error updating payment status:', error));
    }
  };
}
