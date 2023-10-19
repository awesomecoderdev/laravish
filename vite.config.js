import { defineConfig } from "vite";
const { resolve } = require('path');
import laravel from "laravel-vite-plugin";
import mkcert from 'vite-plugin-mkcert'
const ASSET_URL = process.env.ASSET_URL || '';
export default defineConfig({
    server: {
        host: "127.0.0.1",
        server: { https: true },
    },
    root: 'resources',
    base: `${ASSET_URL}/dist/`,

    build: {
        outDir: resolve(__dirname, 'public/dist'),
        emptyOutDir: true,
        manifest: true,
        target: 'es2018',
        rollupOptions: {
            input: '/js/app.js',
            output: {
                assetFileNames: '[ext]/[name][extname]',
                chunkFileNames: '[chunks]/[name].[hash].js',
                entryFileNames: 'js/app.js'
            }
        }
    },
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
        [ mkcert() ]
        // react(),
    ],
    resolve: {
    alias: {
        '@': '/js',
    }
},
});
