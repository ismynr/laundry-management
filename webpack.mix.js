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

 // mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    // dashboard
    'public/assets/vendors/css/vendor.bundle.base.css',
    'public/assets/css/style.css',
    'public/assets/images/favicon.png',

    // pages
    
], 'public/css/all.css');

mix.scripts([
    // dashboard
    'public/assets/vendors/js/vendor.bundle.base.js',
    'public/assets/vendors/chart.js/Chart.min.js',
    'public/assets/js/off-canvas.js',
    'public/assets/js/hoverable-collapse.js',
    'public/assets/js/misc.js',
    'public/assets/js/dashboard.js',
    'public/assets/js/todolist.js',

    // pages

], 'public/js/all.js');