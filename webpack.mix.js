const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .browserSync({
        proxy: 'localhost:8000',
        files: [
            'public/css/app.css',
            'public/js/app.js',
            'app/**/*',
            'routes/**/*',
            'resources/views/**/*',
            'resources/lang/**/*'
        ]
    });
