<script lang="ts">
export default {
  name: "ProductCardComponent",
  props: {
    name: {
      type: String,
      required: true
    },
    price: {
      type: Number,
      required: true
    },
    priceOld: {
      type: Number
    },
    promoName: {
      type: String
    },
    imageUrl: {
      type: String,
      required: true
    },
    imageThumb: {
      type: String
    }
  },
  methods: {
    formatPrice(price: number): string {
      const priceFormatted = Intl.NumberFormat('pt-BR', {
        currency: 'BRL', 
        style: 'currency'
      }).format(price);

      return priceFormatted;
    },
  },
  data() {
    return {
      isHover: false
    }
  }
}
</script>

<template>
  <div class="card">
    <div
      @mouseover="isHover = true"
      @mouseleave="isHover = false"
      class="image-container"
    >
      <img
        v-show="!imageThumb || !isHover"
        :src="imageUrl"
        alt=""
      >
      <img
        v-if="imageThumb"
        v-show="isHover"
        :src="imageThumb"
        alt=""
      >
    </div>
    
    <div class="details-container">
      <div class="card-title">{{ name }}</div>
      <div class="price-container">
        <div>
          <span v-if="priceOld" class="price-old">
            {{ formatPrice(priceOld) }}
          </span>
          <strong class="current-price">
            {{ formatPrice(price) }}
          </strong>
        </div>
        <span class="installments">
          4x {{ formatPrice(price / 4) }}
        </span>
      </div>
      <span v-if="promoName" class="promo">
        {{ promoName }}
      </span>
    </div>
  </div>
</template>

<style scoped lang="less">
  .card {
    width: 19rem;
    gap: 1rem;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;

    img {
      width: 100%;
      height: 30rem;
      object-fit: cover;
      cursor: pointer;
    }

    .details-container {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      width: 100%;

      .card-title {
        margin-bottom: 0.5rem;
        line-height: 1.2;
      }

      .price-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;

        & > div {
          display: flex;
          justify-content: flex-start;
          align-items: center;
          gap: 1rem;
        }

        .price-old {
          text-decoration: line-through;
        }

        .installments {
          color: var(--color-text-gray);
        }
      }

      .promo {
        background-color: var(--color-background-dark);
        color: var(--white);
        font-weight: 700;
        padding: 0 1rem;
        margin-top: 0.5rem;
      }
    }
  }

</style>
