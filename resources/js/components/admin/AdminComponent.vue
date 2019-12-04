<template>
  <div>
    <ul class="nav bg-dark">
      <li class="nav-item">
        <router-link :to="{name: 'admin.dashboard'}" class="nav-link">Darhboard</router-link>
      </li>
      <li class="nav-item">
        <router-link
          :to="{name: 'admin.categories'}"
          class="nav-link"
        >categories ({{ totalCategories }})</router-link>
      </li>
      <li class="nav-item">
        <router-link :to="{name: 'admin.products'}" class="nav-link">Produtos</router-link>
      </li>
    </ul>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    totalCategories() {
      return this.$store.state.categories.items.length;
    }
  }
};
</script>

<style scoped>
</style>
