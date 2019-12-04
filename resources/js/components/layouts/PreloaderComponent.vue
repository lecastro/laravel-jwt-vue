<template>
  <div class="loading" v-show="loading">
    <img src="/img/orca.gif" alt="preloader" />
  </div>
</template>
<script>
export default {
  computed: {
    loading() {
      return this.$store.state.Preloader.loading;
    }
  }
};
</script>

<style scoped>
.loading {
  background: #000;
  position: absolute;
  z-index: 9999;
  opacity: 0.2;
  width: 100%;
  height: 100%;
  margin: 0;
  text-align: center;
  padding: 5% 0;
}
.loading img {
  max-width: 200px;
}
</style>
