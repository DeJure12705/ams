import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/guest.css',
                'resources/js/axios.js',
                'resources/js/dashboard.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        proxy: {
            '/app': 'http://localhost', // Proxy Laravel requests to your Laravel app
        },
        cors: {
            origin: 'http://localhost', // Allow your Laravel app to access the Vite server
            methods: ['GET', 'POST', 'PUT', 'DELETE'],
            allowedHeaders: ['Content-Type', 'Authorization'],
        },
    },
});
