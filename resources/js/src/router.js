import { createRouter, createWebHistory } from "vue-router";

import dashboard from './admin/dashboard.vue'
import home from "./pages/home.vue"
import notfound from "./pages/notfound.vue"

const routes = [
    {
        path: "/admin",
        component: dashboard
    },
    {
        path: "/",
        component : home
    },
    {
        path : "/:pathMatch(.*)*",
        component: notfound
    }

    
]

const router = createRouter({
    history: createWebHistory(),
    routes
})


export default router;