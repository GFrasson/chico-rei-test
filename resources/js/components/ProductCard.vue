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
  }
}
</script>

<template>
  <div class="card">
    <img :src="imageUrl" alt="">
    
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
    // height: 35rem;
    gap: 1rem;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;

    img {
      width: 100%;
      height: 30rem;
      object-fit: cover;
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

  // @media (min-width: 956px) {
  //   .card {
  //     flex-direction: row;
  //     width: 32rem;
  //     height: 20em;

  //     img {
  //       height: 100%;
  //       width: auto;
  //       margin-right: 1.25rem;
  //       margin-bottom: 0;
  //     }

  //     .details-container {
  //       height: 100%;
  //       justify-content: space-between;
  //     }
  //   }
  // }

</style>
