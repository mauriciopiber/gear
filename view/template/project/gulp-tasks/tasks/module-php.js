var gulp = require('gulp');
var gulpif = require('gulp-if');
var shell = require('gulp-shell')
var gutil = require('gulp-util');
var watch = require('gulp-watch');

var requireDir = require('require-dir');
var argv = require('yargs').argv;
var exec = require('child_process').exec;

var Server = require('karma').Server;
var jshint = require('gulp-jshint');
var protractor = require("gulp-protractor").protractor;

var phpcpd = require('gulp-phpcpd');
var codecept = require('gulp-codeception');
var phplint = require('phplint').lint


gulp.task('module:phpcs', function(done) {

    if (argv.module == undefined || !argv.module) {
        gutil.log('É obrigatório definir --module');
        return;
    }

    return exec('vendor/bin/phpcs --standard=PSR2 module/'+argv.module+'/src/'+argv.module, function(err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        done(err);

    });
});

gulp.task('module:phpmd', function(done) {

    if (argv.module == undefined || !argv.module) {
        gutil.log('É obrigatório definir --module');
        return;
    }

    return exec('vendor/bin/phpmd module/'+argv.module+'/src/'+argv.module+' text config/jenkins/phpmd.xml', function(err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        done(err);
    });

});

gulp.task('module:phpcpd', function(done) {

    if (argv.module == undefined || !argv.module) {
        gutil.log('É obrigatório definir --module');
        return;
    }

    return exec('vendor/bin/phpcpd module/'+argv.module+'/src/'+argv.module, function(err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        done(err);
    });

});

gulp.task('module:phpunit', function() {

    if (argv.module == undefined || !argv.module) {
        gutil.log('É obrigatório definir --module');
        return;
    }

    var options = {};
    options.testSuite = 'unit';
    options.flags = '-c module/'+argv.module;

    return gulp.src('module/Trend/codeception.yml').pipe(codecept('./vendor/bin/codecept', options));
});


gulp.task('module:phplint', function(cb) {

	if (argv.module == undefined || !argv.module) {
        gutil.log('É obrigatório definir --module');
        return;
    }

	phplint(['./module/'+argv.module+'/**/*.php'***REMOVED***, function (err, stdout, stderr) {
	  if (err) {
		  cb(err);
		  process.exit(1);
	  }
	  cb();
	});
});