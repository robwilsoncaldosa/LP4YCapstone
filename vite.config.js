import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel([
            'resources/js/app.js',
        ]),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~@fortawesome': path.resolve(__dirname, 'node_modules/@fortawesome/fontawesome-free/css/all.css'),
            '~jquery': path.resolve(__dirname, 'node_modules/jquery/dist/jquery.min.js'),
            '~jquery-ui': path.resolve(__dirname, 'node_modules/jquery-ui-dist/jquery-ui.js'),
            '~jquery-ui-css': path.resolve(__dirname, 'node_modules/jquery-ui-dist/jquery-ui.css'),



        }
    },
});