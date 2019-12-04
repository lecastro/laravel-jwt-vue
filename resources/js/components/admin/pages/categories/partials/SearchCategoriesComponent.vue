<template>
  <div>
    <form class="form from-inline" @submit.prevent="search()">
      <input type="text" placeholder="Pequisar" v-model="filter" class="from-control mr-sm-2" />
      <button type="submit" class="btn btn-outline-success">Pesquisar...</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      filter: ""
    };
  },
  methods: {
    search() {
      this.$emit("searchCategory", this.filter);
    }
  }
};
</script>
