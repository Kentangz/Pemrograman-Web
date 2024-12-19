<template>
  <nav class="navbar">
    <div class="logo">
      <i class=""></i> Buk Stur
    </div>
    <ul class="navbar-links">
      <!-- Conditional rendering for 'Home' link -->
      <li v-if="isHomeRoute">
        <a href="#home">Home</a>
      </li>
      <li v-else>
        <router-link to="/">Home</router-link>
      </li>

      <!-- Conditionally hide 'Books List' and 'Search' based on the current route -->
      <template v-if="!isExcludedRoute">
        <a href="#books-list">Books List</a>
        <a href="#search">Search</a>
      </template>

      <li><router-link to="/add-book">Add Book</router-link></li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Navbar",
  computed: {
    // Check if the current route is the home route
    isHomeRoute() {
      return this.$route.path === "/";
    },
    // Determine if the current route should exclude the "Books List" and "Search" links
    isExcludedRoute() {
      const excludedPaths = [
        '/add-book',
        '/category-list',
        '/category-list/create-book-category',
        '/add-book/create-book',
      ];
      return excludedPaths.includes(this.$route.path);
    }
  }
};
</script>

<style scoped>
@import "../style.css";
</style>
