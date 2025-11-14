let mix = require('laravel-mix');

mix.setPublicPath('dist')
    .js('resources/js/script.js', 'dist')
    .js('resources/js/Cookies.js', 'dist')
    .sass('resources/scss/style.scss', 'dist');