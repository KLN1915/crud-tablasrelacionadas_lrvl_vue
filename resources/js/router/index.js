import { createRouter, createWebHistory } from 'vue-router';

import taskIndex from '../components//tasks/Index.vue';
import taskFormCreate from '../components//tasks/TaskFormCreate.vue';
import notFound from '../components/NotFound.vue'

import categoryForm from '../components/categories/CategoryForm.vue'
import categoryFormCreate from '../components/categories/CategoryFormCreate.vue'

const routes = [
    {
        path:'/tareas',
        name:'tasks.index',
        component: taskIndex
    },
    {
        path:'/tareas/crear',
        name:'tasks.create',
        component: taskFormCreate
    },
    {
        path:'/tareas/:id/editar',
        name:'tasks.edit',
        component: taskFormCreate
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