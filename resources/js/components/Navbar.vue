<script lang="ts">
export default {
  name: "NavbarComponent"
}
</script>

<template>
  <header>
    <router-link to="/" class="logo">
      <img src="https://chico-rei.imgix.net/images/site/2021/brand/chico-rei-text.svg" alt="Logo" />
    </router-link>

    <h2 class="title">Produtos</h2>

    <div class="logo-icon-container">
      <img class="logo-icon" src="../../assets/logo-icon.svg" alt="Ícone logo">
    </div>
  </header>
</template>

<style scoped lang="less">
header {
  position: fixed;
  top: 0;
  width: 100%;
  height: 4rem;
  background-color: var(--color-background-300);

  display: flex;
  justify-content: space-between;
  align-items: center;

  padding: 0 2rem;
  
  .title {
    font-weight: 700;
    font-size: 1.6rem;
  }

  .logo {
    height: 1.5rem;

    img {
      width: auto;
      height: 100%;
      object-fit: cover;
    }
  }

  .logo-icon-container {
    width: 7.5rem;
    display: flex;
    justify-content: flex-end;

    .logo-icon {
      height: 2rem;
      width: 2rem;
    }
  }
}
</style>