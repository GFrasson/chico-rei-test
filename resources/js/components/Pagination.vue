<script lang="ts">
import { PhCaretLeft, PhCaretRight } from '@phosphor-icons/vue';

export default {
  name: "PaginationComponent",
  components: {
    PhCaretLeft,
    PhCaretRight
  },
  props: {
    totalPages: {
      type: Number,
      required: true
    }
  }
}
</script>

<template>
  <div class="pagination">
    <button class="page-before">
      <PhCaretLeft :size="20" /> ANTERIOR
    </button>
    <button
      v-for="page in totalPages"
      class="page-number"
    >
      {{ page }}          
    </button>
    <button class="page-next">
      PRÓXIMA <PhCaretRight :size="20" />
    </button>
  </div>
</template>

<style scoped lang="less">
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.5rem;

  & > button:hover {
    color: var(--color-primary-500);
  }

  .page-before,
  .page-next {
    display: flex;
    justify-content: center;
    align-items: center;

    background: transparent;
    border: 1px solid var(--black);
    padding: 0.5rem 1rem;
    cursor: pointer;
  }

  .page-number {
    border: none;
    background-color: transparent;
    padding: 1rem;
    cursor: pointer;
  }
}
</style>