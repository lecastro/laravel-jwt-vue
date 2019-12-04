import { Promise } from "q";

export default {
    state: {
        items: {
            data: []
        }
    },
    mutations: {
        LOAD_CATEGORIES(state, categories) {
            state.items = categories;
        }
    },
    actions: {
        //listar categorias
        loadCategories(context, params) {
            context.commit('PRELOADER', true);
            axios
                .get("/api/v1/categories", {
                    params
                })
                .then(Response => {
                    context.commit('LOAD_CATEGORIES', Response.data)
                })
                .catch(Response => {
                    console.log(Response);
                })
                .finally(() => {
                    context.commit('PRELOADER', false)
                });
        },

        showCategory(context, id) {
            context.commit('PRELOADER', true);
            return new Promise((resolve, reject) => {
                axios
                    .get(`/api/v1/categories/${id}`)
                    .then(Response => resolve(Response.data))
                    .catch(error => reject(error))
                    .finally(() => {
                        context.commit('PRELOADER', false)
                    });
            });
        },
        //cadastrar categorias
        storeCategory(context, params) {
            context.commit('PRELOADER', true);
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/v1/categories", params)
                    .then(Response => resolve(Response))
                    .catch(error => reject(error))
                    .finally(() => {
                        context.commit('PRELOADER', false)
                    });
            });
        },
        //atualizar
        updateCategory(context, params) {
            context.commit('PRELOADER', true);
            return new Promise((resolve, reject) => {
                axios
                    .put(`/api/v1/categories/${params.id}`, params)
                    .then(Response => resolve(Response))
                    .catch(error => reject(error))
                    .finally(() => {
                        context.commit('PRELOADER', false)
                    });
            });
        },
        //delete
        deleteCategoty(context, id) {
            context.commit('PRELOADER', true);
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/v1/categories/${id}`)
                    .then(Response => resolve(Response.data))
                    .catch(error => reject(error))
                    .finally(() => {
                        context.commit('PRELOADER', false)
                    });
            });
        }
    },
    getters: {

    }
}
