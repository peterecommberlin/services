let mix = require('laravel-mix');
let mix2 = require('laravel-mix');
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

mix.react('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix2.react('resources/assets/js/appq.js', 'public/js')


if (!mix.inProduction())
{
	mix.browserSync('as.eventjuicer.com.local');
}


mix.version();
mix2.version();