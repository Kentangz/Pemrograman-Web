<template>
    <!-- Home Section -->
    <section class="home" id="home">
      <div class="row">
        <div class="content">
          <h3>Buk Stur</h3>
          <p>Welcome to Buk Stur! We offer a variety of books, from fiction to educational. Find the best books for all ages!</p>
          <a href="#" class="btn">Shop Now</a>
        </div>
        <div class="books-slider">
          <a href="#"><img src="../assets/book-1.png" alt="Book 1" /></a>
          <a href="#"><img src="../assets/book-2.png" alt="Book 2" /></a>
          <a href="#"><img src="../assets/book-3.png" alt="Book 3" /></a>
        </div>
      </div>
    </section>
  
    <!-- Book List Section -->
    <BookList />
  </template>
  
  <script>
  import Navbar from "../components/Navbar.vue";
  import Footer from "../components/Footer.vue";
  import BookList from "../components/BookList.vue"; // Import BookList
  
  export default {
    name: "Home",
    components: {
      Navbar,
      Footer,
      BookList, // Register BookList component
    },
  };
  </script>
  
  <style scoped>
  @import '../style.css';
  </style>
  