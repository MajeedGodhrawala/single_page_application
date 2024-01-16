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
                    name: "UnAuthenticat",
                    breadCrumb: [
                        {
                            text: "UnAuthenticat",
                        },
                    ],
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
                path: "/profile",
                component: () => import("./pages/Profile.vue"),
                meta: {
                    title: "Profile",
                    name: "Profile",
                    breadCrumb: [
                        {
                            text: "Profile",
                        },
                    ],
                    requiresAuth: true,
                },
            },
            {
                path: "/user",
                component: () =>
                    import("./pages/user_management/user/Index.vue"),
                meta: {
                    title: "User",
                    name: "User",
                    breadCrumb: [
                        {
                            text: "User",
                        },
                    ],
                    requiresAuth: true,
                },
            },
            {
                path: "/role",
                component: () =>
                    import("./pages/user_management/role/Index.vue"),
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
            {
                path: "/permission",
                component: () =>
                    import("./pages/user_management/permission/Permission.vue"),
                meta: {
                    title: "Permission",
                    name: "Permission",
                    breadCrumb: [
                        {
                            text: "Permission",
                        },
                    ],
                    requiresAuth: true,
                },
            },
            {
                path: "/addhaarCardVerification",
                component: () =>
                    import("./pages/addharCardVerification.vue"),
                meta: {
                    title: "Addhaar Card Verification",
                    name: "Addhaar Card Verification",
                    breadCrumb: [
                        {
                            text: "Addhaar Card Verification",
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
