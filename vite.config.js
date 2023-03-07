import {defineConfig} from 'vite';
import devManifest from 'vite-plugin-dev-manifest';

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [
        devManifest()
    ],
    publicDir: false,
    base: '/build/',
    build: {
        manifest: true,
        outDir: 'public/build/',
        rollupOptions: {
            input: {
                app: './assets/js/app.js',
            },
        },
    },
})