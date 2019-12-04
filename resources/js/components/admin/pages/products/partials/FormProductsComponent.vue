<template>
  <div>
    <form @submit.prevent="hundleForm">
      <div :class="['form-group', {'has-error': errors.name}]">
        <div v-if="errors.name">{{ errors.name[0] }}</div>
        <input
          type="text"
          class="form-control"
          placeholder="Nome da categoria"
          v-model="product.name"
        />
      </div>

      <div :class="['form-group', {'has-error': errors.description}]">
        <div v-if="errors.description">{{ errors.description[0] }}</div>
        <textarea v-model="product.description" cols="30" rows="10" class="form-control"></textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">enviar</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    update: {
      require: false,
      type: Boolean,
      default: false
    },
    product: {
      require: false,
      type: Object,
      default: () => {
        return {
          name: "",
          description: "",
          category_id: 1
          //   image: ""
        };
      }
    }
  },

  data() {
    return {
      form: {},
      errors: {}
    };
  },
  methods: {
    hundleForm() {
      console.log(this.product);
      const action = this.update ? "updateProducts" : "storeProducts";

      this.$store
        .dispatch(action, this.product)
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
