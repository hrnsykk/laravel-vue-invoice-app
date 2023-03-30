import { createRouter, createWebHistory } from "vue-router";

import home from "./pages/home.vue"
import notfound from "./pages/notfound.vue"
import login from "./pages/login.vue"
import invoice from "./pages/invoice.vue"
import Product from "./pages/product.vue"
import Category from "./pages/category.vue"

import dashboard from "./layouts/dashboard.vue"
import blank from "./layouts/blank.vue"


const routes = [
    { path: "/", name: "HomePage",  component : home, meta : { layout: dashboard , requiresAuth: true} },
    { path: "/invoice", name: "InvoicePage" , component : invoice , meta : { layout: dashboard , requiresAuth: true}},
    { path: "/product" , name : "Product" , component : Product , meta :{ layout : dashboard, requiresAuth: true}},
    { path: "/login", name: "Login", component : login, meta : { layout : blank}},
    { path: "/category", name: "Category", component: Category , meta: {layout : dashboard , requiresAuth: true}},
    { path : "/:pathMatch(.*)*", name: "notfound", component: notfound }
    
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to,from, next) =>{
    if(to.meta.requiresAuth && !localStorage.getItem("token")){
        next({ name : 'Login'})
        return
    }else{
        next();
        return
    }
})
export default router;