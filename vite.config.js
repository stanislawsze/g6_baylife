import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const host = 'g6-baylife.test';
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
            detectTls: host,
        }),
    ],
    server: {
        hmr: {
            host: host,
        },
    }
});
