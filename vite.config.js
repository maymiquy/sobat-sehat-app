import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';

export default defineConfig(({ mode }) => {
    const isProduction = mode === 'production';

    return {
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js',
                    'resources/views/**/*.blade.php',
                ],
                refresh: true,
            }),
        ],
        css: {
            postcss: {
                plugins: [
                    tailwindcss(),
                    autoprefixer(),
                ],
            },
        },
        server: {
            https: isProduction,
        },
        define: {
            'process.env.VITE_ASSET_URL': JSON.stringify(
                isProduction
                    ? 'https://sobat-sehat-community.vercel.app'
                    : 'http://localhost:8000'
            ),
        },
    };
});
