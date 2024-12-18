<template>
    <div>
<!-- Search Section -->
      <section class="search" id="search">
        <div class="search-container">
          <input type="text" placeholder="Search books..." id="search-input" class="search-input" />
          <button class="search-btn">Search</button>
        </div>
      </section>
      <!-- Books List Section -->
      <section class="books-list" id="books-list">
        <h2>Books for Sale</h2>
        <div id="book-list"></div>
      </section>
    </div>
  </template>
  
  <script>
  export default {
    name: "BookList",
  };
  </script>
  
  <style scoped>
@import '../style.css';
  </style>
  