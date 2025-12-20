const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .browserSync({
        proxy: 'website.test', 
        host: 'website.test',
        open: 'external',
        port: 3000,
        files: [
            'resources/views/**/*.blade.php',
            'resources/css/**/*.css',
            'resources/js/**/*.js',
            'public/**/*.(css|js)'
        ],
        open: false,
    });
        require('tailwindcss'),
    ]).version();
