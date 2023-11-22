import "./bootstrap";

import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./Layouts/App.vue";
import Auth from "./Layouts/Auth.vue";
import Guest from "./Layouts/Guest.vue";

import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: Guest,
        children: [
            {
                path: "/",
                component: () => import("./pages/login.vue"),
            },
            {
                path: "/register",
                component: () => import("./pages/register.vue"),
            },
        ],
    },
    {
        path: "/auth",
        component: Auth,
        children: [
            {
                path: "/dashboard",
                component: () => import("./pages/dashboard.vue"),
            },
            {
                path: "/role",
                component: () => import("./pages/role.vue"),
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

createApp(App).use(router, createPinia()).mount("#app");
