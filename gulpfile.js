var elixir = require('laravel-elixir');

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
    mix.sass([
        'app.scss'
    ], 'public/css/app.css')
    .less([
        '../../../node_modules/selectize/src/less/selectize.less'
    ], 'public/css/plugins.css')
    .copy(
        'node_modules/selectize/dist/js/selectize.js',
        'public/js/plugins/'
    )
    .browserSync({
        proxy: 'esportshero.app'
    })
});
