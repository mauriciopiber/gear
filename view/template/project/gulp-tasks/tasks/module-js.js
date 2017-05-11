var gulp = require('gulp');
var gulpif = require('gulp-if');
var shell = require('gulp-shell')
var gutil = require('gulp-util');
var watch = require('gulp-watch');

var requireDir = require('require-dir');
var argv = require('yargs').argv;
var exec = require('child_process').exec;

var karma = require('karma').Server;
var jshint = require('gulp-jshint');
var protractor = require("gulp-protractor").protractor;

var phpcpd = require('gulp-phpcpd');
var codecept = require('gulp-codeception');
var phplint = require('phplint').lint


gulp.task('module:karma', function(done) {
    if (argv.module == undefined || !argv.module) {
        gutil.log('É obrigatório definir --module');
        return;
    }

    karma.start({
        configFile: __dirname+'/../../module/'+argv.module+'/public/js/spec/karma.conf.js',
        singleRun: true
    }, function() {
        done();
    });
});

gulp.task('module:end2end', function(done) {

    if (argv.module == undefined || !argv.module) {
        gutil.log('É obrigatório definir --module');
        return;
    }

    gulp.src(['./module/'+argv.module+'/public/js/spec/**/*Spec.js'***REMOVED***)
        .pipe(protractor({
               configFile: './module/'+argv.module+'/public/js/spec/end2end.conf.js'
        }))
        .on('error', function(e) { throw e })
        .on('end', function () {
            done();
        });

});

gulp.task('module:jshint', function(done) {

    if (argv.module == undefined || !argv.module) {
        gutil.log('É obrigatório definir --module');
        return;
    }
       // corpo da tarefa

    return gulp.src('./module/'+argv.module+'/public/js/app/**/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'));

});