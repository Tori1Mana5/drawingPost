import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import jquery from 'jquery';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                globals: {
                    jquery: 'window.jQuery',
                }
            }
        }
    }
});
