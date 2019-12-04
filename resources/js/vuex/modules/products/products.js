import axios from 'axios';
import {
    BASE_URL
} from '../../../config.js';

export default {
    state: {
        items: {
            data: []
        }
    },
    mutations: {
        LOAD_PRODUCTS(state, products) {
            state.items = products;
        }
    },
    actions: {
        //listar produtos
        loadProducts(context, params) {
            context.commit('PRELOADER', true);
            axios
                // ${BASE_URL}products
                .get(`${BASE_URL}products`, {
                    params
                })
                .then(Response => context.commit('LOAD_PRODUCTS', Response.data))
                .catch(Response => {
                    console.log(Response)
                })
                .finally(() => {
                    context.commit('PRELOADER', false)
                });
        },
        //cadastrar categorias
        storeProducts(context, params) {
            context.commit('PRELOADER', true);
            return new Promise((resolve, reject) => {
                axios.post(`${BASE_URL}products`, params)
                    .then(Response => resolve(Response))
                    .catch(error => reject(error))
                    .finally(() => {
                        context.commit('PRELOADER', false)
                    });
            });
        }
    },
    getters: {},
}
