<template>
  <div>
    <!-- Search Section -->
    <section class="search" id="search">
      <div class="search-container">
        <input
          type="text"
          placeholder="Search books..."
          id="search-input"
          class="search-input"
          v-model="searchQuery"
          @input="filterBooks"
        />
        <button class="search-btn" @click="filterBooks">Search</button>
      </div>
    </section>

    <!-- Books List Section -->
    <section class="books-list" id="books-list">
      <h2>Books for Sale</h2>
      <div id="book-list" class="books-container">
        <div v-for="book in paginatedBooks" :key="book.id" class="book-card">
          <img
            :src="`http://localhost:8000/storage/${book.image}`"
            :alt="book.book_name"
            class="book-image"
          />
          <div class="book-info">
            <h3>{{ book.book_name }}</h3>
            <p class="author">{{ book.creator }}</p>
            <p class="price">$ {{ book.price }}</p>
            <p class="description">{{ book.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Pagination Section -->
    <section class="pagination">
      <button
        v-for="page in totalPages"
        :key="page"
        @click="currentPage = page"
        :class="{ active: page === currentPage }"
      >
        {{ page }}
      </button>
    </section>
  </div>
</template>

<script>
import api from "../api"; // Import API service

export default {
  name: "BookList",
  data() {
    return {
      books: [], // Array to store fetched books
      searchQuery: "", // For search input
      currentPage: 1, // Current page number
      itemsPerPage: 4, // Number of books per page
    };
  },
  computed: {
    // Filtered books based on search query
    filteredBooks() {
      if (!this.searchQuery) return this.books;
      return this.books.filter((book) =>
        book.book_name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
    // Paginated books for the current page
    paginatedBooks() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.filteredBooks.slice(startIndex, endIndex);
    },
    // Total number of pages
    totalPages() {
      return Math.ceil(this.filteredBooks.length / this.itemsPerPage);
    },
  },
  methods: {
    // Function to fetch books from the API
    fetchBooks() {
      api
        .get("/books")
        .then((response) => {
          this.books = response.data.data;

          // Sort books by `id` in descending order
          this.books.sort((a, b) => b.id - a.id);
        })
        .catch((error) => {
          console.error("There was an error fetching the books data:", error);
        });
    },
    // Trigger filtering on search input
    filterBooks() {
      this.currentPage = 1; // Reset to the first page
    },
  },
  mounted() {
    this.fetchBooks();
  },
};
</script>

<style scoped>
@import '../style.css';

</style>
