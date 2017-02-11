const { mix } = require('laravel-mix')

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.sass', 'public/css')
    .copy('resources/assets/images/*', 'public/images')
    .copy('resources/assets/favicon/*', 'public')
