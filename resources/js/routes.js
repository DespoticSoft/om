import Vue from 'vue';
import VueRouter from 'vue-router';

import ProductCreate from "./pages/product/ProductCreate";
import Dashboard from "./pages/Dashboard";
import ProductIndex from "./pages/product/ProductIndex";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Dashboard
        },
        {
            path: '/product',
            component: ProductIndex
        },
        {
            path: '/product-create',
            component: ProductCreate
        }
    ]
});

export default router;
