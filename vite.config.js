import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import { resolve } from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            "@": resolve(__dirname, "resources/js"),
        },
    },
    server: {
        host: "127.0.0.1", // Use IPv4 localhost
        port: 5173,
        strictPort: true, // Ensure Vite exits if port is already in use
        hmr: {
            host: "127.0.0.1", // Ensure HMR uses IPv4
        },
    },
});
