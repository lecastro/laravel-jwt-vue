require('./bootstrap');
window.Vue = require('vue');
import Snotify from 'vue-snotify';

import router from './routes.js';
import store from './vuex/store.js';

Vue.use(Snotify);

Vue.component('admin-component', require('./components/admin/AdminComponent.vue').default);
Vue.component('preloader-component', require('./components/layouts/PreloaderComponent.vue').default);

const app = new Vue({
    router,
    store,
    el: '#app',
});
