let mix = require('laravel-mix');

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

mix.js('resources/src/js/app.js', 'public/js')
   .sass('resources/src/sass/app.scss', 'public/css');

mix.copy('bower_components/metaphor/dist/js/metaphor.js', 'public/js')
	.copy('bower_components/metaphor/dist/css/metaphor.css', 'public/css');

mix.copy('node_modules/vue-croppa/dist/vue-croppa.min.css', 'public/css')
	.copy('node_modules/vue-croppa/dist/vue-croppa.min.js', 'public/js');