var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
    .sass('app.scss', 'public/css/app.css')
    // .less('app.less', 'public/css/plugins.css')
    .scripts('plugins/*.js', 'public/js/plugins.js')
    .browserify('app.js', 'public/js/app.js')
    .phpUnit()
    .browserSync({ proxy: 'esportshero.app' })
});
