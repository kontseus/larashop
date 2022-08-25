import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/images-preview.js',
                'resources/js/images-actions.js',
                'resources/js/product-actions.js',
                'resources/js/paypal-payments.js',
            ],
            refresh: true,
        }),
    ],
});
