<template>
  <div id="app">
    <!-- Conditionally render Navbar based on the route -->
    <Navbar v-if="showNavbar" />

    <!-- Main Content Area: Where the specific views will be rendered -->
    <router-view />

    <!-- Conditionally render Footer based on the route -->
    <Footer v-if="showFooter" />
  </div>
</template>

<script>
// Import the Navbar and Footer components
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';

export default {
  name: 'App',
  components: {
    Navbar, // Navbar component
    Footer, // Footer component
  },
  computed: {
    // Show Navbar based on the current route
    showNavbar() {
      const noNavbarRoutes = [
        '/add-book/edit-book',
        '/category-list/edit-category',
      ];

      // Check if the current route path starts with any of the noNavbarRoutes
      return !noNavbarRoutes.some(route => this.$route.path.startsWith(route));
    },
    // Show Footer based on the current route
    showFooter() {
      const noFooterRoutes = [
        '/add-book',
        '/category-list',
        '/add-book/create-book',
        '/add-book/edit-book',
        '/category-list/create-book-category',
        '/category-list/edit-category',
      ];

      // Check if the current route path starts with any of the noFooterRoutes
      return !noFooterRoutes.some(route => this.$route.path.startsWith(route));
    },
  },
};
</script>

<style>
/* Global styles for the app, you can import your CSS here */
@import "../src/style.css";
</style>
