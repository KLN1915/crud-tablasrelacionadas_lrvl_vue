import { createRouter, createWebHistory } from 'vue-router';

import productIndex from '../components/Index.vue';
import notFound from '../components/NotFound.vue'

import categoryForm from '../components/categories/CategoryForm.vue'
import categoryFormCreate from '../components/categories/CategoryFormCreate.vue'

const routes = [
    {
        path:'/',
        name:'products.index',
        component: productIndex
    },
    {
        path:'/categorias',
        name:'categories',
        component: categoryForm
    },
    {
        path:'/categorias/crear',
        name:'categories.create',
        component: categoryFormCreate
    },
    {
        path:'/categorias/:id/editar',
        name:'categories.edit',
        component: categoryFormCreate
    },
    {
        path:'/:pathMatch(.*)*',
        name:'notfound',
        component: notFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router