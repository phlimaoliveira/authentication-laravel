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

mix.sass('node_modules/startbootstrap-sb-admin-2/scss/sb-admin-2.scss', 'public/site/sb-admin-2.css')
   .scripts('node_modules/jquery/dist/jquery.js', 'public/site/jquery.js')
   .scripts('node_modules/startbootstrap-sb-admin-2/js/sb-admin-2.min.js', 'public/site/sb-admin-2.min.js');
