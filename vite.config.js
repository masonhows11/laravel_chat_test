import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
//import livewire from '@energize/livewire-vite-plugin';
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        //livewire(),
    ],
    resolve: {
        alias: {
            '$': 'jQuery'
        },
    },
});
