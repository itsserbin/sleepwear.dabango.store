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

mix.js('resources/js/app.js', 'public/js').vue()

    /**
     * Admin JS and CSS.
     */
    .js('resources/js/admin/admin.js', 'public/admin').vue()
    .sass('resources/scss/admin.scss', 'public/admin')

    /**
     * Production JS and CSS
     */
    .sass('resources/scss/app.scss', 'public/css')
    .sass('resources/scss/product/app.scss', 'public/css/product')
    .sass('resources/scss/pages/order.scss', 'public/css/pages');
