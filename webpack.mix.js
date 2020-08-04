const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/dashboard/dashboard.js', 'public/js/dashboard')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/blog.scss', 'public/css')
    .sass('resources/sass/dashboard/login.scss', 'public/css/dashboard')
    .sass('resources/sass/auth/register.scss', 'public/css/auth')
    .sass('resources/sass/dashboard/dashboard.scss', 'public/css/dashboard');
