<template>
  <div id="app">
    <!-- Render Navbar on every page -->
    <Navbar />

    <!-- Main Content Area: Where the specific views will be rendered -->
    <router-view />

    <Footer />


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
};
</script>

<style>
/* Global styles for the app, you can import your CSS here */
@import "../src/style.css";
</style>
