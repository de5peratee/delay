import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/reg.css',
                'resources/css/log.css',
                'resources/css/new.css',
                'resources/js/logValidation.js',
                'resources/js/regValidation.js'
            ],
            refresh: true,
        }),
    ],
});
