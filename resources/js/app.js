import "./bootstrap";

import { createApp } from "vue";
// import { createPinia } from "pinia";

import App from "./Layouts/App.vue";
import { router } from "../js/router.js";

createApp(App).use(router).mount("#app");
