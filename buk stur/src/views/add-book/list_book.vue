<template>
  <div class="container mt-5">
    <!-- Title -->
    <div class="text-center mb-4">
      <h2 class="display-4 font-weight-bold text-primary title-style">Book List</h2>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-end mb-4">
      <router-link to="/create-book" class="btn btn-primary btn-lg me-3">Create New Book</router-link>
      <router-link to="/category-list" class="btn btn-secondary btn-lg">Category List</router-link>
    </div>

    <!-- Books Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover shadow">
        <thead class="bg-light text-center">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Book Name</th>
            <th scope="col">Creator</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="book in paginatedBooks" :key="book.id" class="text-center align-middle">
            <td>{{ book.id }}</td>
            <td>
              <img :src="`http://localhost:8000/storage/${book.image}`" alt="Book Image" class="img-fluid" style="width: 80px; height: 120px; object-fit: cover;" />
            </td>
            <td>{{ book.book_name }}</td>
            <td>{{ book.creator }}</td>
            <td>${{ book.price }}</td>
            <td>{{ book.description }}</td>
            <td>{{ book.category.category_name }}</td>
            <td>
              <div class="d-flex flex-column gap-2">
                <router-link :to="`/edit-book/${book.id}`" class="btn btn-warning">Edit</router-link>
                <button @click="deleteBook(book.id)" class="btn btn-danger">Delete</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation" class="d-flex justify-content-center mt-4">
      <ul class="pagination">
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <button class="page-link" @click="changePage(currentPage - 1)">Previous</button>
        </li>
        <li
          class="page-item"
          :class="{ active: page === currentPage }"
          v-for="page in totalPages"
          :key="page"
        >
          <button class="page-link" @click="changePage(page)">{{ page }}</button>
        </li>
        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
          <button class="page-link" @click="changePage(currentPage + 1)">Next</button>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import api from '../../api';

export default {
  name: 'BooksList',
  data() {
    return {
      books: [], // Array to store all books
      currentPage: 1, // Current page number
      itemsPerPage: 5 // Number of items per page
    };
  },
  computed: {
    // Calculate total pages
    totalPages() {
      return Math.ceil(this.books.length / this.itemsPerPage);
    },
    // Get books for the current page
    paginatedBooks() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.books.slice(start, end);
    }
  },
  methods: {
    // Fetch books data and sort by the latest ID
    fetchBooks() {
      api.get('/books')
        .then(response => {
          this.books = response.data.data.sort((a, b) => b.id - a.id); // Sort by ID (descending)
        })
        .catch(error => {
          console.error('Error fetching books:', error);
        });
    },
    // Delete book
    deleteBook(id) {
      if (confirm('Are you sure you want to delete this book?')) {
        api.delete(`/books/${id}`)
          .then(() => {
            this.books = this.books.filter(book => book.id !== id); // Remove book from the list
          })
          .catch(error => {
            console.error('Error deleting book:', error);
          });
      }
    },
    // Change page
    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
      }
    }
  },
  mounted() {
    this.fetchBooks(); // Fetch books when the component is mounted
  }
};
</script>

<style scoped>
/* Title styling */
.title-style {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Elegant and minimalist font */
  font-weight: 700; /* Bold font weight */
  font-size: 3rem; /* Larger font size */
  color: #333; /* Dark color for a minimalist and modern look */
  text-transform: uppercase; /* Make the text uppercase for a clean, minimalist style */
  letter-spacing: 1px; /* Slightly increase the spacing between letters */
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle text shadow for elegance */
  margin-bottom: 1.5rem; /* Spacing below the title */
}
/* Table styling */
.table {
  font-size: 1.2rem;
  border-radius: 8px;
}
.table th,
.table td {
  vertical-align: middle; /* Center content vertically */
}
.table th {
  font-weight: 700;
}
.table tbody tr:hover {
  background-color: #f9f9f9;
}

/* Button styling */
.btn {
  font-size: 1rem;
}
.btn-warning,
.btn-danger {
  width: 100%; /* Buttons stretch to fill cell width */
}
</style>
