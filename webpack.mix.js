let mix = require('laravel-mix');

mix.setPublicPath('dist')
    .js('resources/js/cookies.js', 'dist')
    .js('resources/js/modal.js', 'dist')
    .sass('resources/scss/style.scss', 'dist');