import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/index.tsx'
            ],
            refresh: [
                'routes/**',
                'resources/routes/**',
                'resources/views/**',
                'resources/pages/**',
                'resources/components/**',
                'resources/scss/**'
            ]
        }),
        react(),
    ]
});
