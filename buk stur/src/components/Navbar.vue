<template>
    <nav class="navbar">
      <div class="logo">
        <i class=""></i> Buk Stur
      </div>
      <ul class="navbar-links">
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/books-list">Book List</router-link></li>
        <li><router-link to="/search">Search</router-link></li>
        <li><router-link to="/add-book">Add Book</router-link></li> <!-- Updated the link -->
      </ul>
    </nav>
  </template>
  
  <script>
  export default {
    name: "Navbar",
  };
  </script>
  
  <style scoped>
 @import '../style.css';
  </style>
  