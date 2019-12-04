<template>
  <div>
    <form @submit.prevent="hundleForm">
      <div :class="['form-group', {'has-error': errors.name}]">
        <div v-if="errors.name">{{ errors.name[0] }}</div>
        <input
          type="text"
          class="form-control"
          placeholder="Nome da categoria"
          v-model="category.name"
        />
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">enviar</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errors: {}
    };
  },
  props: {
    category: {
      require: false,
      type: Object | Array,
      default: () => {
        return {
          id: "",
          name: ""
        };
      }
    },
    update: {
      require: false,
      type: Boolean,
      default: false
    }
  },
  methods: {
    hundleForm() {
      const action = this.update ? "updateCategory" : "storeCategory";

      this.$store
        .dispatch(action, this.category)
        .then(() => {
          //alert
          this.$snotify.success("Sucesso para cadastrar."),
            //redirecionar
            this.$router.push({ name: "admin.categories" });
        })
        .catch(error => {
          this.$snotify.error("ALgo deu errado.", "Error"),
            (this.errors = error.response.data.errors);
        });
    }
  }
};
</script>

<style scoped>
.has-error {
  color: red;
}
.has-error input {
  border: 1px solid red;
}
</style>
