const { resolve } = require('node:path');
const { defineConfig } = require('vite');

module.exports = defineConfig(({ mode }) => ({
    build: {
        outDir: 'dist',
        emptyOutDir: true,
        manifest: false,
        minify: mode === 'development' ? false : 'oxc',
        cssMinify: mode !== 'development',
        license: { fileName: 'cookies.js.LICENSE.txt' },
        rolldownOptions: {
            input: {
                script: resolve(__dirname, 'resources/js/script.js'),
                cookies: resolve(__dirname, 'resources/js/Cookies.js'),
                style: resolve(__dirname, 'resources/css/style.css'),
            },
            output: {
                entryFileNames: '[name].js',
                assetFileNames: (assetInfo) => assetInfo.name?.endsWith('.css')
                    ? 'style.css'
                    : '[name][extname]',
            },
        },
    },
}));