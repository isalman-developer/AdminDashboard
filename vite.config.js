import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        // Laravel plugin: connects Laravel with Vite
        laravel({
            input: [
                'resources/js/app.js', // Entry point for our Vue app
                'resources/js/admin.js' // Entry point for admin assets
            ], 
            refresh: true, // Auto-refresh browser on changes
        }),
        // Vue plugin: lets Vite understand Vue files
        vue(),
        tailwindcss(), // Tailwind CSS plugin for utility-first CSS
    ],
    resolve: {
        alias: {
            // '@' shortcut points to our Vue source folder
            // Instead of writing '../../../src', we can write '@'
            '@': path.resolve(__dirname, 'resources/js/src'),
            
            // Use the full Vue build (needed for some features)
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    server: {
        host: 'localhost', // Where Vite runs
        port: 5173,        // Port number for Vite dev server
    },
});