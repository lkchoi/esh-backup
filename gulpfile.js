var gulp = require('gulp');
var elixir = require('laravel-elixir');
var spawn = require('child_process').spawn;
var node;

require('laravel-elixir-vueify');

elixir(function(mix) {
    mix .phpUnit()
        .sass('app.scss', 'public/css/app.css')
        .scripts('plugins/*.js', 'public/js/plugins.js')
        .browserify('app.js', 'public/js/app.js')
})

/**
 * $ gulp server
 * description: launch the node server.
 * If there's a server already running, kill it.
 */
gulp.task('server', function() {
    if (node) node.kill();
    node = spawn('node', ['socket.js'], { stdio: 'inherit' });
    node.on('close', function(code) {
        if (code === 8) {
            console.log('Error detected, waiting for changes...');
        }
    })
})

// clean up if an error goes unhandled.
process.on('exit', function() {
    if (node) node.kill();
})