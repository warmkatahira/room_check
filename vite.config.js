import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        laravel(
            [
                // 共通
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/scss/theme.scss',
                'resources/scss/navigation.scss',
                'resources/scss/navigation_hamburger.scss',
                // 進捗
                'resources/js/progress/category_select.js',
                // 荷主マスタ
                'resources/js/customer/customer.js',
            ],
        ),
    ],
});
