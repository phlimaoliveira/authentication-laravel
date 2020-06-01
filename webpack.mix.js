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
   .js('node_modules/jquery.easing/jquery.easing.min.js', 'public/site/jquery.easing.min.js')
   .js('node_modules/startbootstrap-sb-admin-2/vendor/chart.js/Chart.min.js', 'public/site/Chart.min.js')
   .js('node_modules/startbootstrap-sb-admin-2/js/demo/chart-area-demo.js', 'public/site/chart-area-demo.js')
   .js('node_modules/startbootstrap-sb-admin-2/js/demo/chart-pie-demo.js', 'public/site/chart-pie-demo.js')
   .js('node_modules/startbootstrap-sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js', 'public/site/bootstrap.bundle.min.js')
   .sass('resources/views/scss/style.scss', 'public/site/style.css');