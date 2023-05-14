<script lang="ts">
import ProductCard from '../components/ProductCard.vue';
import Pagination from '../components/Pagination.vue';
import axios from 'axios';

interface Product {
  id: string;
  name: string;
  price: number;
  price_old?: number;
  promo_name?: string;
  img_cover: string;
  img_thumb?: string;
}

export default {
  name: "ProductsView",
  components: {
    ProductCard,
    Pagination,
  },
  async mounted() {
    try {
      const response = await axios.get('/api/products', {
        params: {
          page: this.currentPage
        }
      });
      
      this.products = response.data.payload.products;
    } catch (err) {
      console.error(err);
    }
  },
  data() {
    return {
      products: [] as Product[],
      currentPage: 1,
      totalPages: 7
    }
  }
}
</script>

<template>
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
      :totalPages="totalPages"
    />
  </footer>
</template>

<style scoped lang="less">
main {
  max-width: 90%;
  margin: 6rem auto 2rem;
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
