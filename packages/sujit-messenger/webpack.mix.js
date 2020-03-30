const mix = require('laravel-mix');
require('laravel-mix-purgecss');

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

mix.js('./resources/assets/src/js/app.js', './resources/assets/app/js')
    .sass('./resources/assets/src/scss/app.scss', './resources/assets/app/css')
    .purgeCss();
