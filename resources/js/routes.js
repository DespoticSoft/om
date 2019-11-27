import Vue from 'vue';
import VueRouter from 'vue-router';

import ProductCreate from "./pages/product/ProductCreate";
import Dashboard from "./pages/Dashboard";
import ProductIndex from "./pages/product/ProductIndex";
import CategoryCreate from "./pages/category/CategoryCreate";
import ProductUpdate from "./pages/product/ProductUpdate";
import ProductView from "./pages/product/ProductView";
import CategoryIndex from "./pages/category/CategoryIndex";

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
            name: 'product',
            component: ProductIndex
        },
        {
            path: '/product-view/:id',
            name: 'product-view',
            component: ProductView,
            params: true
        },
        {
            path: '/product-create',
            name: 'product-create',
            component: ProductCreate
        },
        {
            path: '/product-update/:id',
            name: 'product-update',
            component: ProductUpdate,
            params: true
        },

        {
            path: '/category',
            name: 'category',
            component: CategoryIndex,
        },
        {
            path: '/category-create',
            name: 'category-create',
            component: CategoryCreate
        }
    ]
});

export default router;
