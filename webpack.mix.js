let mix = require('laravel-mix');

mix.setPublicPath('dist')
    .js('resources/js/script.js', 'dist')
    .version();