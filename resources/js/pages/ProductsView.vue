<script lang="ts">
import { PhSlidersHorizontal } from '@phosphor-icons/vue';
import ProductCard from '../components/ProductCard.vue';
import Pagination from '../components/Pagination.vue';
import { listProducts } from '../services/productsService';

interface Product {
  id: string;
  name: string;
  price: number;
  price_old?: number;
  promo_name?: string;
  img_cover: string;
  img_thumb?: string;
}

interface Filters {
  types: string[];
}

export default {
  name: "ProductsView",
  components: {
    ProductCard,
    Pagination,
    PhSlidersHorizontal
  },
  async mounted() {
    const { products, filters } = await listProducts(this.currentPage, this.typeSelected);
    this.products = products;
    this.filters = filters;
  },
  data() {
    return {
      products: [] as Product[],
      filters: {} as Filters,
      typeSelected: null,
      currentPage: 1,
      totalPages: 7
    }
  },
  methods: {
    async goToPage(page: number) {
      this.currentPage = page;
      const { products } = await listProducts(this.currentPage, this.typeSelected);
      this.products = products;

      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    },
    async handleTypeFilterChange(event) {
      this.typeSelected = event.target.value;
      const { products } = await listProducts(this.currentPage, this.typeSelected);
      this.products = products;
    }
  }
}
</script>

<template>
  <div class="filters">
    <PhSlidersHorizontal :size="32" />
    
    <select
      class="type"
      name="type"
      id="type"
      @change="handleTypeFilterChange($event)"
    >
      <option value="" disabled selected>TIPO</option>
      <option
        v-if="filters.hasOwnProperty('types')"
        v-for="filterType of filters.types"
        :value="filterType"
        :selected="typeSelected === filterType"
      >
        {{ filterType }}
      </option>
    </select>
  </div>

  <main>
    <ProductCard
      v-if="products.length > 0"
      v-for="product of products"
      :key="product.id"
      :name="product.name"
      :price="product.price"
      :price-old="product.price_old"
      :promo-name="product.promo_name"
      :image-url="product.img_cover"
      :image-thumb="product.img_thumb"
    />
    <h2 v-else>Carregando os produtos...</h2>
  </main>

  <footer>
    <Pagination
      :total-pages="totalPages"
      :current-page="currentPage"
      :go-to-page="goToPage"
    />
  </footer>
</template>

<style scoped lang="less">
.filters {
  margin: 6rem auto 0 auto;
  max-width: 90%;

  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 2rem;
  
  & > select {
    background-color: transparent;
    border: 1px solid var(--black);
    padding: 0.25rem 0.5rem;
    width: 12rem;
    font-size: 0.9rem;
    cursor: pointer;
    transition: 0.2s all;

    &:hover {
      background-color: var(--color-background-dark);
      color: var(--white);
      transition: 0.2s all;
    }
  }
}

main {
  max-width: 95%;
  margin: 1rem auto 2rem;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  flex-wrap: wrap;
  row-gap: 1rem;
  column-gap: 0.5rem;
}

footer {
  margin: 2rem 0;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
