import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/Home.vue'),
  },
  {
    path: '/add-book',
    name: 'List_book',
    component: () => import('../views/add-book/list_book.vue'),  // Updated path
  },
  {
    path: '/category-list',
    name: 'CategoryList',
    component: () => import('../views/add-book/category/list_category.vue'), // Updated path
  },
  {
    path: '/create-category',
    name: 'CreateCategory',
    component: () => import('../views/add-book/category/create_category.vue') // Create category page
  },
  {
    path: '/edit-category/:id',
    name: 'EditCategory',
    component: () => import('../views/add-book/category/edit_category.vue') // Edit category page
  },
  {
    path: '/create-book',
    name: 'CreateBook',
    component: () => import('../views/add-book/create_book.vue')
  },
  {
    path: '/edit-book/:id',
    name: 'EditBook',
    component: () => import('../views/add-book/edit_book.vue')
  }
  // Other routes for actual page navigation
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
