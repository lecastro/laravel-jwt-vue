<template>
  <div>
    <h1>Lista de produtos</h1>
    <div class="row">
      <div class="col">
        <button class="btn btn-success" @click.prevent="showModal = true">Novo</button>

        <modal :show="showModal" animation="zoom" @hide="hideModal" :width="600" :height="500">
          <formProduct></formProduct>
        </modal>
      </div>
      <div class="col">
        <Search @searchProduct="Formsearch"></Search>
      </div>
    </div>
    <table class="table table-dark">
      <thead>
        <tr>
          <th>ID</th>
          <th>ID CATEGORIA</th>
          <th>DESCRIÇÃO</th>
          <th>IMAGE</th>
          <th width="100">AÇÕES</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item ,index) in products.data" :key="index">
          <td>{{ item.id }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.category_id }}</td>
          <td>
            <router-link
              :to="{name: 'admin.categories.update', params: {id: item.id}}"
              class="btn btn-info"
            >Editar</router-link>
            <a href="#" class="btn btn-danger" @click.prevent="Confirmdestroy(item)">Remover</a>
          </td>
        </tr>
      </tbody>
    </table>
    <pagination :pagination="products" :offset="6" @paginate="loadProducts"></pagination>
  </div>
</template>

<script>
import Vodal from "vodal";

import PaginationComponent from "../../../layouts/PaginationComponent.vue";
import SearchProductsComponent from "./partials/SearchProductsComponent.vue";
import FormProductsComponent from "./partials/FormProductsComponent.vue";

export default {
  data() {
    return {
      search: "",
      showModal: false
    };
  },

  created() {
    this.loadProducts(1);
  },

  methods: {
    loadProducts(page) {
      this.$store.dispatch("loadProducts", { ...this.params, page });
    },

    Confirmdestroy() {},

    Formsearch(filter) {
      this.search = filter;
      this.loadProducts(1);
    },

    hideModal() {
      this.showModal = false;
    }
  },

  computed: {
    products() {
      return this.$store.state.Products.items;
    },
    params() {
      return {
        page: this.products.current_page,
        filter: this.search
      };
    }
  },
  components: {
    pagination: PaginationComponent,
    Search: SearchProductsComponent,
    formProduct: FormProductsComponent,
    modal: Vodal
  }
};
</script>
