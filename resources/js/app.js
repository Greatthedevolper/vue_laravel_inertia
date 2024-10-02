import "./bootstrap";
import "../css/app.css";

import { initializeApp } from "firebase/app";
import { getAuth } from "firebase/auth";
import { getDatabase } from "firebase/database";

const firebaseConfig = {
    apiKey: "AIzaSyC_vxSuLnDDWbJDOiP6aDWw334mVY5ZdG8",
    authDomain: "laravel-inertia-996f5.firebaseapp.com",
    databaseURL: "https://laravel-inertia-996f5-default-rtdb.firebaseio.com",
    projectId: "laravel-inertia-996f5",
    storageBucket: "laravel-inertia-996f5.appspot.com",
    messagingSenderId: "19479149469",
    appId: "1:19479149469:web:9e8c55201fb278173d0d74",
    measurementId: "G-D62FGQ4QBT",
};

// Initialize Firebase
const firebaseApp = initializeApp(firebaseConfig);
const auth = getAuth(firebaseApp);
const database = getDatabase(firebaseApp);

// Optionally register your firebase instance with Inertia if needed
// Inertia.registerPlugin('firebase', () => {
//   return firebaseApp;
// });

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import Layout from "./Layouts/DefaultLayout.vue";

createInertiaApp({
    title: (title) => `${title} | Inertia`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || Layout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Head", Head)
            .component("Link", Link)
            .mount(el);
    },
    progress: {
        color: "#fff",
        includeCSS: false,
        showSpinner: true,
    },
});
