var gulp = require('gulp');
var Server = require('karma').Server;
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


gulp.task('file:phplint', function(cb) {

	return phplint(['./module/'+argv.module+'/src/'+argv.module+'/'+argv.file***REMOVED***, function (err, stdout, stderr) {
	  if (err) {
		  cb(err);
		  process.exit(1);
	  }
	  cb();
	});
});

gulp.task('file:phpcs', function(done) {


    return exec('vendor/bin/phpcs --standard=PSR2 module/'+argv.module+'/src/'+argv.module+'/'+argv.file, function(err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        done(err);

    });
});

gulp.task('file:phpmd', function(done) {



    return exec('vendor/bin/phpmd module/'+argv.module+'/src/'+argv.module+'/'+argv.file+' text config/jenkins/phpmd.xml', function(err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        done(err);
    });

});

gulp.task('file:phpcpd', function(done) {

    return exec('vendor/bin/phpcpd module/'+argv.module+'/src/'+argv.module, function(err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        done(err);
    });

});

gulp.task('file:phpunit', function() {


    var options = {};
    options.testSuite = 'unit';
    options.flags = '-c module/'+argv.module;

    testName = argv.file.split('/');
    var testFileName = 'module/'+argv.module+'/test/unit/'+argv.module+'Test/';

    for (i = 0; i < testName.length; i++) {

    	if (testName[i***REMOVED***.substr(testName[i***REMOVED***.length-4, 4) == '.php') {

    		phpfile = testName[i***REMOVED***.split('.');

    		testFileName += phpfile[0***REMOVED***+'Test.php';

    		break;

    	}

    	testFileName += testName[i***REMOVED***+'Test/';
    }

    options.testClass = testFileName;

    //gutil.log(testFileName);
    //return;

    return gulp.src('module/'+argv.module+'/codeception.yml').pipe(codecept('./vendor/bin/codecept', options));
});