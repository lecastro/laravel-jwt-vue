import Vue from 'vue';
import Vuex from 'vuex';

import Categories from './modules/categories/categories.js';
import Preloader from './modules/preloader/preloader.js';
import Products from './modules/products/products.js';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        categories: Categories,
        Preloader,
        Products
    },
});

export default store;
