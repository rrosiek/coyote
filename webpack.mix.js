const { mix } = require('laravel-mix')

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.sass', 'public/css')
    .copyDirectory('resources/assets/images', 'public/images')
    .copyDirectory('resources/assets/favicon', 'public')
    // .browserSync({ proxy: 'coyote.app' })
