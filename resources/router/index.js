import {createRouter, createWebHistory} from "vue-router";

const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../pages/Home.vue'),
    },
    {
        path: '/:pathMatch(.*)',
        name: 'NotFound',
        component: () => import('../pages/404.vue'),
    },
    {
        path: '/registration',
        name: 'Registration',
        component: () => import('../pages/Registration.vue')
    }
]

export default createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: 'active',
    linkExactActiveClass: 'active'
})
