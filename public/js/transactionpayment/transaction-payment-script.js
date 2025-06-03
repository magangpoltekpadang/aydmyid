function transactionPaymentData() {
  return {
    transactionPayments: [],
    transactions: [],
    paymentMethods: [],
    transactionServices: [],
    showDeleteModal: false,
    showCreateModal: false,
    showEditModal: false,
    transactionPaymentIdToDelete: null,
    editedTransactionPayment: {
      payment_id: '',
      transaction_id: '',
      payment_method_id: '',
      amount: '',
      payment_date: '',
      reference_number: '',
      status_id: '',
      notes: ''
    },

    init() {
      this.fetchTransactionPayments();
      this.fetchTransactions();
      this.fetchPaymentMethods();
      this.fetchTransactionServices();
    },

    async fetchTransactionPayments() {
      try {
        const query = `
          query {
            transactionPayments{
              payment_id
              transaction_id
              payment_method_id
              amount
              payment_date
              reference_number
              status_id
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
          console.error('GraphQL errors:', result.errors);
          return;
        }

        console.log('Fetched data:', result.data.transactionPayments);

        this.transactionPayments = result.data.transactionPayments || [];

      } catch (error) {
        console.error('Error fetching Transaction Payments:', error);
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

    async fetchPaymentMethods() {
      try {
        const query = `
        query {
          paymentMethods {
            payment_method_id
            method_name
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

      this.paymentMethods = result.data.paymentMethods || [];
      } catch (error) {
        console.error('Error fetching paymentMethod :', error);
      }
    },

    async fetchTransactionServices() {
      try {
        const query = `
        query {
          transactionServices {
            transaction_service_id
            status
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

      this.transactionServices = result.data.transactionServices || [];
      } catch (error) {
        console.error('Error fetching transactionServices:', error);
      }
    },


    confirmDelete(id) {
      this.transactionPaymnetIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(transactionPayment) {
      this.editedTransactionPayment = { ...transactionPayment };
      this.showEditModal = true;
    },

    async deleteTransactionPayment() {
      try {
        const response = await fetch(`/transaction-payment/${this.transactionPaymentIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchTransactionPayments();
        }
      } catch (error) {
        console.error('Error deleting TransactionPayment:', error);
      }
    },

    async updateTransactionPayment() {
      fetch(`/transaction-payment/${this.editedTransactionPayment.transaction_payment_id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(this.editedTransactionPayment)
      })
        .then(response => response.json())
        .then(data => {
          this.showEditModal = false;
          this.fetchTransactionPayments();
        })
        .catch(error => console.log('Error updating TransactionPayment:', error));
    }
  };
}