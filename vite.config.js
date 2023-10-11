import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "foundandscan.co.bd",
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
            valetTls: "foundandscan.co.bd",
        }),
        // react(),
    ],
});
