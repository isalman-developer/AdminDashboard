import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        // Laravel plugin: connects Laravel with Vite
        laravel({
            input: [
                'resources/js/app.js', // Entry point for our app
            ], 
            refresh: true, // Auto-refresh browser on changes
        }),
        tailwindcss(), // Tailwind CSS plugin for utility-first CSS
    ],
    server: {
        host: 'localhost', // Where Vite runs
        port: 5173,        // Port number for Vite dev server
    },
});