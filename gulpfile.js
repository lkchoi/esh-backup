var gulp = require('gulp')
var elixir = require('laravel-elixir')
var spawn = require('child_process').spawn
require('laravel-elixir-vueify')


elixir(function(mix) {
    mix .phpUnit()
        .sass('app.scss', 'public/css/app.css')
        .scripts('plugins/*.js', 'public/js/plugins.js')
        .browserify('app.js', 'public/js/app.js')
        .browserSync({
            proxy: 'esportshero.app',
            port: 4000,
            ui: { port: 4001 }
        })
    // gulp.watch(['./socket.js'], ['server']);
})

// /**
//  * $ gulp server
//  * description: launch the node server.
//  * If there's a server already running, kill it.
//  */
// var node; // process
// gulp.task('server', function() {
//     if (node) {
//         node.kill();
//     }
//     node = spawn('node', ['socket.js'], { stdio: 'inherit' });
//     node.on('close', function(code) {
//         if (code === 8) {
//             console.log('Error detected, waiting for changes...');
//         }
//     });
// })

// // clean up if an error goes unhandled.
// process.on('exit', function() {
//     if (node) {
//         node.kill();
//     }
// })