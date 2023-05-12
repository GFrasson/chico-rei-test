import { createRouter, createWebHistory } from 'vue-router';
import ProductsView from '../pages/ProductsView.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'products',
      component: ProductsView
    },
  ]
})

export default router
