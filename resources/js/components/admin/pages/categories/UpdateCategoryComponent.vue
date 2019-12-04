<template>
  <div>
    <h1>Editar Categoria</h1>
    <FormComponent :category="category" :update="true"></FormComponent>
  </div>
</template>
<script>
import FormComponent from "./partials/FormComponenet.vue";
export default {
  data() {
    return {
      category: {}
    };
  },
  props: {
    id: {
      require: true
    }
  },
  created() {
    this.loadCategory();
  },
  methods: {
    loadCategory() {
      this.$store
        .dispatch("showCategory", this.id)
        .then(response => (this.category = response))
        .catch(error => {
          this.$snotify.error("ALgo deu errado.",'404'),
          this.$router.push({ name: "admin.categories" });
        });
    }
  },
  components: {
    FormComponent
  }
};
</script>

<style scoped>
</style>
