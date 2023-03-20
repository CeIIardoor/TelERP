import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
            reactivityTransform: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                inlineDynamicImports: false,
                manualChunks: {
                    'vue': ['vue'],
                    'echarts': ['echarts'],
                }
            },
        },
        minify: 'terser'
    }
});
