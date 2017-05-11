var gulp = require('gulp');
var karma = require('karma').Server;
var jshint = require('gulp-jshint');
var protractor = require("gulp-protractor").protractor;
var codecept = require('gulp-codeception');
var gutil = require('gulp-util');
var watch = require('gulp-watch');
var argv = require('yargs').argv;
var gulpif = require('gulp-if');
var shell = require('gulp-shell')
var phpcpd = require('gulp-phpcpd');
var exec = require('child_process').exec;
var phplint = require('phplint').lint



gulp.task('file:karma', function(done) {
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

gulp.task('file:end2end', function(done) {

    if (argv.module == undefined || !argv.module) {
        gutil.log('É obrigatório definir --module');
        return;
    }

    if (argv.suite == undefined || !argv.suite) {
        gutil.log('É obrigatório definir --suite');
        return;
    }

    gulp.src(['./module/'+argv.module+'/public/js/spec/**/*Spec.js'***REMOVED***)
        .pipe(protractor({
               configFile: './module/'+argv.module+'/public/js/spec/end2end.conf.js',
               args: [
                      '--suite', argv.suite
                  ***REMOVED***
        }))
        .on('error', function(e) { throw e })
        .on('end', function () {
            done();
        });

});


gulp.task('file:jshint', function(done) {

    if (argv.module == undefined || !argv.module) {
        gutil.log('É obrigatório definir --module');
        return;
    }

    if (argv.suite == undefined || !argv.suite) {
        gutil.log('É obrigatório definir --suite');
        return;
    }
       // corpo da tarefa

    return gulp.src(
        [
            './module/'+argv.module+'/public/js/app/'+argv.suite+'/**/*.js',
            './module/'+argv.module+'/public/js/spec/unit/'+argv.suite+'Spec/**/*Spec.js',
            './module/'+argv.module+'/public/js/spec/e2e/'+argv.suite+'/**/*Spec.js',
        ***REMOVED***
    )
    .pipe(jshint())
    .pipe(jshint.reporter('default'));

});