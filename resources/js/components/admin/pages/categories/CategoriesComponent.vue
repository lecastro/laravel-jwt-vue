<template>
  <div>
    <h1>Listagem de Categorias</h1>
    <div class="row">
      <div class="col">
        <router-link :to="{name: 'admin.categories.create'}" class="btn btn-success">cadastrar</router-link>
      </div>
      <div class="col">
        <SearchComponent @searchCategory="search"></SearchComponent>
      </div>
    </div>

    <table class="table table-dark">
      <thead>
        <tr>
          <th>ID</th>
          <th>NOME</th>
          <th width="200">AÇÕES</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item , index) in categories" :key="index">
          <td>{{ item.id }}</td>
          <td>{{ item.name }}</td>
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
  </div>
</template>

<script>
import axios from "axios";
import { ifError } from "assert";
import { timeout } from "q";

import SearchComponent from "./partials/SearchCategoriesComponent";

export default {
  data() {
    return {
      name: ""
    };
  },
  created() {
    this.loadCategories();
  },
  computed: {
    categories() {
      return this.$store.state.categories.items;
    }
  },
  methods: {
    loadCategories() {
      this.$store.dispatch("loadCategories", { name: this.name });
    },
    Confirmdestroy(categoty) {
      this.$snotify.error(
        `Deseja realmente deletar essa categoria: ${categoty.name}`,
        {
          timeout: 10000,
          showProgressBar: true,
          closeOnClick: true,
          buttons: [
            {
              text: "Não",
              action: categoty => {
                console.log("Não Deleta"), this.$snotify.remove(categoty.id);
              }
            },
            {
              text: "Sim",
              action: () => this.destroy(categoty)
            }
          ]
        }
      );
    },

    destroy(categoty) {
      this.$store
        .dispatch("deleteCategoty", categoty.id)
        .then(() => {
          this.$snotify.success(`Deletado com sucesso ${categoty.name}`),
            this.loadCategories();
        })
        .catch(error => {
          this.$snotify.error("ALgo deu errado.", "404");
        });
    },

    search(filter) {
      this.name = filter;
      this.loadCategories();
      console.log(this.name);
    }
  },
  components: {
    SearchComponent
  }
};
</script>

<style scoped>
</style>
