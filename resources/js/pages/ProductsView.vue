<script lang="ts">
import ProductCard from '../components/ProductCard.vue';
import axios from 'axios';

export default {
  name: "ProductsView",
  components: {
    ProductCard
  },
  async mounted() {
    // const response = await axios.get('/api/products');
    // console.log(response.data.payload);
  },
  data() {
    return {
      products: [
        {
          "tenant_id": 1,
          "fabric_id": 168,
          "promo_combo_unit_price": 0,
          "link": "\/camiseta\/camiseta-capybara-s-road-8487.html",
          "discount": 53,
          "img_cover_gender": "M",
          "in_stock": true,
          "price_min": 0,
          "type": {
            "plural": "Camisetas",
            "observations": "As medidas podem variar at\u00e9 2 cm;Este produto pode encolher em at\u00e9 5% ap\u00f3s a primeira lavagem;Toda nossa linha de vestu\u00e1rio \u00e9 produzida artesanalmente por nossa equipe",
            "name": "Camiseta",
            "id": 1,
            "sort": 1,
            "google_category": 212,
            "url": "camiseta"
          },
          "promo_group": null,
          "promo_instruction": "",
          "img_female": "https:\/\/chicorei.imgix.net\/8487\/35b153f0-6cce-11ed-9c5c-bba4246d3784.jpg",
          "price": 34.9,
          "img_thumb": "https:\/\/chico-rei.imgix.net\/images\/fabric\/VD1337_fabric_168_2.jpg?mark-alpha=90&mark-scale=80&mark-align=middle,center&mark=https%3A%2F%2Fchicorei.imgix.net%2F8487%2F4e6098d0-2909-11eb-ab5c-a7371c52ab78.png",
          "img_male": "https:\/\/chicorei.imgix.net\/8487\/494240e1-28af-11ed-b984-17efb5f107ae.jpg",
          "id": 8487,
          "price_old": 74.99,
          "is_new": false,
          "promo_name": "53% OFF",
          "img_thumb_png": "https:\/\/chicorei.imgix.net\/8487\/4e6098d0-2909-11eb-ab5c-a7371c52ab78.png",
          "store": null,
          "img_cover": "https:\/\/chicorei.imgix.net\/8487\/494240e1-28af-11ed-b984-17efb5f107ae.jpg",
          "fabrics": [
            {
              "product_color_id": 4,
              "hexa": "#454B65",
              "name": "AZ8225",
              "product_color_name": "Azul Surf",
              "product_color_hexa": "#455491",
              "id": 18
            },
            {
              "product_color_id": 10,
              "hexa": "#000000",
              "name": "PT6500",
              "product_color_name": "Preto Noir",
              "product_color_hexa": "#000000",
              "id": 22
            },
            {
              "product_color_id": 21,
              "hexa": "#A5A4A1",
              "name": "Mescla Escuro",
              "product_color_name": "Mescla Gaivota",
              "product_color_hexa": "#B3B5B7",
              "id": 35
            },
            {
              "product_color_id": 9,
              "hexa": "#5C3E3C",
              "name": "MR837",
              "product_color_name": "Marrom Sucupira",
              "product_color_hexa": "#67473F",
              "id": 115
            },
            {
              "product_color_id": 16,
              "hexa": "#B1464E",
              "name": "VM909",
              "product_color_name": "Vermelho Goiaba",
              "product_color_hexa": "#B1464E",
              "id": 135
            },
            {
              "product_color_id": 29,
              "hexa": "#67734e",
              "name": "VD1337",
              "product_color_name": "Verde S\u00e1lvia",
              "product_color_hexa": "#79A675",
              "id": 168
            }
          ],
          "name": "Camiseta Capybara's Road",
          "promo_combo": 3,
          "price_max": 0
        },
      ]
    }
  }
}
</script>

<template>
  <main>
    <ProductCard
      v-for="product of products"
      :key="product.id"
      :name="product.name"
      :price="product.price"
      :price-old="product.price_old"
      :promo-name="product.promo_name"
      :image-url="product.img_cover"
    />
  </main>
</template>

<style scoped lang="less">
main {
  max-width: 90%;
  margin: 6rem auto 2rem;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  flex-wrap: wrap;
  gap: 2rem;
}
</style>
