function transactionServiceData() {
  return {
    transactionServices: [],
    transactions: [],
    services: [],
    staffs: [],
    showDeleteModal: false,
    showCreateModal: false,
    showEditModal: false,
    transactionServiceIdToDelete: null,
    editedTransactionService: {
      transaction_service_id: '',
      transaction_id: '',
      service_id: '',
      quantity: '',
      unit_price: '',
      discount: '',
      total_price: '',
      worker_id: '',
      start_time: '',
      end_time: '',
      status: '',
      notes: ''
    },

    init() {
      this.fetchTransactionServices();
      this.fetchTransactions();
      this.fetchServices();
      this.fetchStaffs();
    },

    async fetchTransactionServices() {
      try {
        const query = `
          query {
            transactionServices {
              transaction_service_id
              transaction_id
              service_id
              quantity
              unit_price
              discount
              total_price
              worker_id
              start_time
              end_time
              status
              notes
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
          console.log('GraphQL errors:', result.errors);
          return;
        }

        console.log('Fetched data:', result.data.transactionServices);

        this.transactionServices = result.data.transactionServices || [];
      } catch (error) {
        console.error('Error fetching transactionServices:', error);
      }
    },

    async fetchTransactions() {
      try {
        const query = `
        query {
          transactions {
            transaction_id
            transaction_code
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

        this.transactions = result.data.transactions || [];
      } catch (error) {
        console.error('Error fetching transactions:', error);
      }
    },

    async fetchServices() {
      try {
        const query = `
        query {
          services {
            service_id
            service_name
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

        this.services = result.data.services || [];
      } catch (error) {
        console.error('Error fetching services:', error);
      }
    },

    async fetchStaffs() {
      try {
        const query = `
        query {
          staffs {
            staff_id
            name
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

        this.staffs = result.data.staffs || [];
      } catch (error) {
        console.error('Error fetching staffs:', error);
      }
    },


    confirmDelete(id) {
      this.transactioServiceIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(transactioService) {
      this.editedTransactionService = { ...transactioService };
      this.showEditModal = true;
    },

    async deleteTransactionService() {
      try {
        const response = await fetch(`/transaction-service/${this.transactioServiceIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchTransactionServices();
        }
      } catch (error) {
        console.error('Error deleting Transaction Service:', error);
      }
    },

    async updateTransactionService() {
      fetch(`/transaction-service/${this.editedTransactionService.transaction_service_id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(this.editedTransactionService)
      })
        .then(response => response.json())
        .then(data => {
          this.showEditModal = false;
          this.fetchTransactionServices(); // refresh data dari server
        })
        .catch(error => console.log('Error updating TransactionService:', error));
    }
  };
}
