import Auth from "./Layouts/Auth.vue";
import Guest from "./Layouts/Guest.vue";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        redirect: "/dashboard",
        meta: {
            requiresAuth: false,
        },
    },
    {
        path: "/guest",
        name: "Guest",
        component: Guest,
        children: [
            {
                path: "/login",
                component: () => import("./pages/login.vue"),
                meta: {
                    title: "Login",
                    requiresAuth: false,
                },
            },
            {
                path: "/register",
                component: () => import("./pages/register.vue"),
                meta: {
                    title: "Register",
                    requiresAuth: false,
                },
            },
        ],
    },
    {
        path: "/auth",
        name: "Auth",
        component: Auth,
        children: [
            {
                path: "/unauthenticat",
                component: () => import("./pages/unauthenticat.vue"),
                meta: {
                    title: "Page Not Found",
                    requiresAuth: true,
                },
            },
            {
                path: "/dashboard",
                component: () => import("./pages/dashboard.vue"),
                meta: {
                    title: "Dashboard",
                    name: "DashBoard",
                    breadCrumb: [
                        {
                            text: "DashBoard",
                        },
                    ],
                    requiresAuth: true,
                },
            },
            {
                path: "/role",
                component: () => import("./pages/role.vue"),
                meta: {
                    title: "Role",
                    name: "Role",
                    breadCrumb: [
                        {
                            text: "Role",
                        },
                    ],
                    requiresAuth: true,
                },
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    document.title = to.meta?.title ?? "Page Not Found";

    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (!localStorage.token) {
            router.push({
                path: "/login",
                component: () => import("./pages/login.vue"),
            });
        } else {
            next();
        }
    } else if (to.matched.length == 0) {
        router.push({
            path: "/unauthenticat",
        });
    } else if (localStorage.token) {
        router.push({
            path: "/",
        });
    } else {
        next();
    }
});

export { router };
