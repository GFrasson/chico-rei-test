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
    },
    currentPage: {
      type: Number,
      required: true
    },
    goToPage: {
      type: Function,
      required: true
    }
  }
}
</script>

<template>
  <div class="pagination">
    <button
      :disabled="currentPage <= 1"
      @click="currentPage > 1 && goToPage(currentPage - 1)"
      class="page-before"
    >
      <PhCaretLeft :size="18" /> ANTERIOR
    </button>
    <button
      v-for="page in totalPages"
      @click="goToPage(page)"
      :class="{ 'page-number': true, active: page === currentPage }"
    >
      {{ page }}
    </button>
    <button
      :disabled="currentPage >= totalPages"
      @click="currentPage < totalPages && goToPage(currentPage + 1)"
      class="page-next"
    >
      PRÓXIMA <PhCaretRight :size="18" />
    </button>
  </div>
</template>

<style scoped lang="less">
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.5rem;

  & > button:not(:disabled):hover {
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

    &:disabled {
      border: 1px solid var(--color-gray-500);
      cursor: initial;
    }
  }

  .page-number {
    border: none;
    background-color: transparent;
    padding: 1rem;
    cursor: pointer;

    &.active {
      font-weight: 700;
    }
  }
}
</style>