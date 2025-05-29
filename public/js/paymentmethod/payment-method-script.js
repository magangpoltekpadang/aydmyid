function paymentMethodData() {
  return {
    paymentMethods: [],
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
    paymentMethodIdToDelete: null,
    editedPaymentMethod: {
        payment_method_id: null,
        method_name: '',
        code: '',
    },
    

    init() {
      this.fetchPaymentMethods();
    },

    async fetchPaymentMethods() {
            try {
                const query = `
                    query($search: String, $is_active: Boolean) {
                        paymentMethods(search: $search, is_active: $is_active) {
                        payment_method_id
                        method_name
                        code
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
                
                console.log('Fetched data:', result.data.paymentMethods);

                this.paymentMethods = result.data.paymentMethods || [];

                if (this.status !== '') {
                    const isActiveBool = this.status === '1';
                    this.paymentMethods = this.paymentMethods.filter(v => v.is_active === isActiveBool);
                }

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.paymentMethods = this.paymentMethods.filter(v =>
                        v.method_name.toLowerCase().includes(lowerSearch) 
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.paymentMethods.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.paymentMethods.length;
            } catch (error) {
                console.error('Error fetching Payment Method:', error);
            }
        },

    changePage(page) {
      if (page === '...') return;
      this.pagination.current_page = parseInt(page);
      this.fetchPaymentMethods(page);
    },

    previousPage() {
      if (this.pagination.current_page > 1) {
        this.pagination.current_page--;
        this.fetchPaymentMethods();
      }
    },

    nextPage() {
      if (this.pagination.current_page < this.pagination.last_page) {
        this.pagination.current_page++;
        this.fetchPaymentMethods();
      }
    },

    resetFilters() {
      this.search = '';
      this.status = '';
      this.pagination.current_page = 1;
      this.fetchPaymentMethods();
    },

    confirmDelete(id) {
      console.log('Deleting ID:', id); // cek apakah ID-nya muncul
      this.paymentMethodIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(paymentMethod) {
      this.editedPaymentMethod = { ...paymentMethod };
      this.showEditModal = true;
    },

    async deletePaymentMethod() {
      try {
        const response = await fetch(`/payment-method/${this.paymentMethodIdToDelete}`, {
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
          await this.fetchPaymentMethods();
        }
      } catch (error) {
        console.error('Error:', error);
      }
    },

    async updatePaymentMethod() {
      fetch(`/payment-method/${this.editedPaymentMethod.payment_method_id}`, {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.editedPaymentMethod)
      })
      .then(response => response.json())
      .then(data => {
          this.showEditModal = false;
          this.fetchPaymentMethods(); // refresh data dari server
      })
      .catch(error => console.log('Error updating Payment Method:', error));
    }
  };
}
