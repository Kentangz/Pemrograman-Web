import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/Home.vue'),
  },
  {
    path: '/add-book',
    name: 'ListBook',
    component: () => import('../views/add-book/list_book.vue'),  // Updated path for the book list
  },
  {
    path: '/category-list',
    name: 'CategoryList',
    component: () => import('../views/add-book/category/list_category.vue'), // Category list view
  },
  {
    path: '/category-list/create-book-category',
    name: 'CreateCategory',
    component: () => import('../views/add-book/category/create_category.vue') // Path to create category
  },
  {
    path: '/category-list/edit-category/:id',
    name: 'EditCategory',
    component: () => import('../views/add-book/category/edit_category.vue') // Edit category by ID
  },
  {
    path: '/add-book/create-book',
    name: 'CreateBook',
    component: () => import('../views/add-book/create_book.vue'), // Updated path for creating a book
  },
  {
    path: '/add-book/edit-book/:id',
    name: 'EditBook',
    component: () => import('../views/add-book/edit_book.vue') // Edit book by ID
  }
  // Other routes for actual page navigation
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
