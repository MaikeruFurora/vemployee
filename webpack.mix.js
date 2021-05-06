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

mix.js('resources/js/app.js', 'public/js')
//    .js(['public/asset/js/app.js','public/asset/js/vendors.js'],'public/js/apps.js')
//    .styles(['public/asset/css/style.css','public/asset/css/vendors.css'],'public/css/apps.css')
   .sass('resources/sass/app.scss', 'public/css').disableNotifications();
// mix.browserSync('127.0.0.0.1');
