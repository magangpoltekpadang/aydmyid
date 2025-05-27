function membershipPackageData() {
  return {
    membershipPackages: [],
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
    membershipPackageIdToDelete: null,
    

    init() {
      this.fetchMembershipPackages();
    },

    async fetchMembershipPackages() {
            try {
                const query = `
                    query($search: String, $is_active: Boolean) {
                        membershipPackages(search: $search, is_active: $is_active) {
                        package_id
                        package_name
                        duration_days
                        price
                        max_vehicles
                        description
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
                    console.log('GraphQL errors:', result.errors);
                    return;
                }
                console.log('Fetched data:', result.data.membershipPackages);

                this.membershipPackages = result.data.membershipPackages || [];

                if (this.status !== '') {
                    const isActiveBool = this.status === '1';
                    this.membershipPackages = this.membershipPackages.filter(v => v.is_active === isActiveBool);
                }

                if (this.search) {
                    const lowerSearch = this.search.toLowerCase();
                    this.membershipPackages = this.membershipPackages.filter(v =>
                        v.package_name.toLowerCase().includes(lowerSearch) 
                    );
                }

                // Karena kita belum dapat info pagination dari GraphQL, kita hitung manual
                this.pagination.total = this.membershipPackages.length;
                this.pagination.last_page = 1;
                this.pagination.from = 1;
                this.pagination.to = this.membershipPackages.length;
            } catch (error) {
                console.error('Error fetching vehicle types:', error);
            }
        },

    changePage(page) {
      if (page === '...') return;
      this.pagination.current_page = parseInt(page);
      this.fetchMembershipPackages(page);
    },

    previousPage() {
      if (this.pagination.current_page > 1) {
        this.pagination.current_page--;
        this.fetchMembershipPackages();
      }
    },

    nextPage() {
      if (this.pagination.current_page < this.pagination.last_page) {
        this.pagination.current_page++;
        this.fetchMembershipPackages();
      }
    },

    resetFilters() {
      this.search = '';
      this.status = '';
      this.pagination.current_page = 1;
      this.fetchMembershipPackages();
    },

    confirmDelete(id) {
      console.log('Deleting ID:', id); // cek apakah ID-nya muncul
      this.membershipPackageIdToDelete = id;
      this.showDeleteModal = true;
    },

    async deleteMemebershipPackage() {
      try {
        const response = await fetch(`/membership-package/${this.membershipPackageIdToDelete}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (response.ok) {
          this.showDeleteModal = false;
          await this.fetchMembershipPackages();
        }
      } catch (error) {
        console.error('Error:', error);
      }
    }
  };
}
