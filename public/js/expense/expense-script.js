function expenseData() {
  return {
    expenses: [],
    outlets: [],
    shifts: [],
    staffs: [],
    showDeleteModal: false,
    showCreateModal: false,
    showEditModal: false,
    expenseIdToDelete: null,
    editedExpense: {
      expense_code: '',
      outlet_id: '',
      mamount: '',
      category: '',
      description: '',
      staff_id: '',
      shift_id: ''
    },

    init() {
      this.fetchExpenses();
      this.fetchOutlets();
      this.fetchStaffs();
      this.fetchShifts();
    },

    async fetchExpenses() {
      try {
        const query = `
          query {
            expenses{
              expense_id
              expense_code
              outlet_id
              expense_date
              amount
              category
              description
              staff_id
              shift_id
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

        console.log('Fetched data:', result.data.expenses);

        this.expenses = result.data.expenses || [];

      } catch (error) {
        console.error('Error fetching Expenses:', error);
      }
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

    async fetchShifts() {
      try {
        const query = `
        query {
          shifts {
            shift_id
            shift_name
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

      this.shifts = result.data.shifts || [];
      } catch (error) {
        console.error('Error fetching shift :', error);
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
      this.expenseIdToDelete = id;
      this.showDeleteModal = true;
      this.showCreateModal = false;
      this.showEditModal = false;
    },

    startEdit(expense) {
      this.editedExpense = { ...expense };
      this.showEditModal = true;
    },

    async deleteExpense() {
      try {
        const response = await fetch(`/expense/${this.expenseIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchExpenses();
        }
      } catch (error) {
        console.error('Error deleting Expense:', error);
      }
    },

    async updateExpense() {
      fetch(`/expense/${this.editedExpense.expense_id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(this.editedExpense)
      })
        .then(response => response.json())
        .then(data => {
          this.showEditModal = false;
          this.fetchExpenses(); // refresh data dari server
        })
        .catch(error => console.log('Error updating Expense:', error));
    }
  };
}
