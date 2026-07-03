import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            'ziggy-js': path.resolve('vendor/tightenco/ziggy'),
        },
    },
    server: {
        host: '0.0.0.0', // Crucial for Docker
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true, // Needed if your OS doesn't pass file change events into Docker cleanly
        },
    },
});
