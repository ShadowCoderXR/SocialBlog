import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/style.css',
                'resources/js/main.js',
                'resources/css/styles.css',
                'resources/js/datatables-simples-demo.js',
                'resources/js/scripts.js',
            ],
            refresh: true,
        }),
    ],
});
