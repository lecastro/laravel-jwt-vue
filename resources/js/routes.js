import Vue from 'vue';
import VueRouter from 'vue-router';

import AdminComponent from './components/admin/AdminComponent.vue';
import CategoriesComponent from './components/admin/pages/categories/CategoriesComponent';
import DashboardComponent from './components/admin/pages/dashboard/DashboardComponent.vue';
import AddCategoryComponent from './components/admin/pages/categories/AddCategoryComponent.vue';
import UpdateCategoryComponent from './components/admin/pages/categories/UpdateCategoryComponent.vue';
import ProducsComponent from './components/admin/pages/products/ProductComponent.vue';

Vue.use(VueRouter);

const routes = [{
        path: '/admin',
        component: AdminComponent,
        children: [{
                path: '',
                component: DashboardComponent,
                name: 'admin.dashboard'
            },
            {
                path: 'categories',
                component: CategoriesComponent,
                name: 'admin.categories'
            },
            {
                path: 'categories/create',
                component: AddCategoryComponent,
                name: 'admin.categories.create'
            },
            {
                path: 'categories/:id/update',
                component: UpdateCategoryComponent,
                name: 'admin.categories.update',
                props: true,
            },
            {
                path: 'products',
                component: ProducsComponent,
                name: 'admin.products'
            },
        ]
    },

];

const router = new VueRouter({
    routes
});

export default router;
