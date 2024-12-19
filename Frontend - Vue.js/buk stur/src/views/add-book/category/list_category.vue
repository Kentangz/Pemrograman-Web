<template>
  <div class="container mt-5">
    <!-- Header Section -->
    <div class="text-center mb-4">
      <h2 class="display-4 font-weight-bold text-primary title-style">Category List</h2>
    </div>

    <!-- Create Category Button -->
    <div class="d-flex justify-content-end mb-4">
      <router-link to="/category-list/create-book-category" class="btn btn-outline-primary btn-lg shadow-sm">Create New Category</router-link>
    </div>

    <!-- Categories Table -->
    <div class="table-responsive">
      <table class="table table-hover table-bordered shadow-sm">
        <thead class="bg-light text-muted">
          <tr>
            <th scope="col" class="font-weight-bold text-center">ID</th>
            <th scope="col" class="font-weight-bold text-center">Category Name</th>
            <th scope="col" class="font-weight-bold text-center">Description</th>
            <th scope="col" class="font-weight-bold text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in paginatedCategories" :key="category.id">
            <td class="text-center">{{ category.id }}</td>
            <td class="text-center">{{ category.category_name }}</td>
            <td class="text-center">{{ category.description }}</td>
            <td class="d-flex flex-column align-items-center">
              <!-- Edit Category Button -->
              <router-link :to="`/category-list/edit-category/${category.id}`" class="btn btn-outline-warning btn-sm mb-2 shadow-sm">
                <i class="bi bi-pencil-fill"></i> Edit
              </router-link>

              <!-- Delete Category Button -->
              <button @click="deleteCategory(category.id)" class="btn btn-outline-danger btn-sm shadow-sm">
                <i class="bi bi-trash-fill"></i> Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination Controls -->
    <nav class="mt-4">
      <ul class="pagination justify-content-center">
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <button class="page-link" @click="changePage(currentPage - 1)" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </button>
        </li>
        <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
          <button class="page-link" @click="changePage(page)">{{ page }}</button>
        </li>
        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
          <button class="page-link" @click="changePage(currentPage + 1)" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </button>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import api from '../../../api';

export default {
  name: 'CategoryList',
  data() {
    return {
      categories: [], // Array to store category data
      currentPage: 1,
      itemsPerPage: 10
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.categories.length / this.itemsPerPage);
    },
    paginatedCategories() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.categories.slice(start, end);
    }
  },
  methods: {
    fetchCategories() {
      // Call the API to fetch categories data
      api.get('/categories')
        .then(response => {
          this.categories = response.data.data;
        })
        .catch(error => {
          console.error("There was an error fetching the categories data: ", error);
        });
    },
    deleteCategory(id) {
      // Confirm if the user wants to delete the category
      if (confirm('Are you sure you want to delete this category?')) {
        api.delete(`/categories/${id}`)
          .then(() => {
            this.categories = this.categories.filter(category => category.id !== id);
          })
          .catch(error => {
            console.error("There was an error deleting the category: ", error);
          });
      }
    },
    changePage(page) {
      if (page > 0 && page <= this.totalPages) {
        this.currentPage = page;
      }
    }
  },
  mounted() {
    this.fetchCategories();
  }
};
</script>


<style scoped>
.title-style {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Elegant and minimalist font */
  font-weight: 700; /* Bold font weight */
  font-size: 2.8rem; /* Larger font size */
  color: #333; /* Dark color for a minimalist and modern look */
  text-transform: uppercase; /* Make the text uppercase for a clean, minimalist style */
  letter-spacing: 1px; /* Slightly increase the spacing between letters */
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle text shadow for elegance */
  margin-bottom: 1rem; /* Spacing below the title */
}
.table {
  font-size: 1.1rem;
  border-radius: 8px;
}

.table thead {
  background-color: #8f8f8f;
  text-align: center;
}

.table tbody tr:hover {
  background-color: #f1f1f1;
}

.btn {
  padding: 0.5rem 1.2rem;
  font-size: 1rem;
  border-radius: 25px;
}

.btn-outline-primary:hover {
  background-color: #00743a;
  color: #fff;
}

.btn-outline-warning:hover {
  background-color: #977100;
  color: #fff;
}

.btn-outline-danger:hover {
  background-color: #82020f;
  color: #fff;
}

.shadow-sm {
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.pagination .page-item.active .page-link {
  background-color: #007bff;
  border-color: #007bff;
  color: white;
}
</style>
