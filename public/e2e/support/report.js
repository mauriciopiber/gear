var Cucumber = require('cucumber');
    fs = require('fs-extra');
    path = require('path');



var outputDir = path.join(__dirname, '../../../../../build/logs');

var reportFile = path.join(outputDir, 'cucumber-test-results.json');



module.exports = function JsonOutputHook() {


this.After(function(scenario, callback) {
  if (scenario.isFailed()) {
    browser.takeScreenshot().then(function(base64png) {
      var decodedImage = new Buffer(base64png, 'base64').toString('binary');
      scenario.attach(decodedImage, 'image/png');
      callback();
    }, function(err) {
      callback(err);
    });
  } else {
    callback();
  }
});

var createHtmlReport = function(reportFile) {
  var CucumberHtmlReport = require('cucumber-html-report');
  var report = new CucumberHtmlReport({
    source: reportFile, // source json
    dest: outputDir+'/../features' // target directory (will create if not exists)
  });
  report.createReport();
};

var JsonFormatter = Cucumber.Listener.JsonFormatter();
JsonFormatter.log = function(string) {

	fs.open(reportFile, 'w+', function (err, fd) {
	    if (err) {
	        fs.mkdirsSync(reportsDir);
	        fd = fs.openSync(reportFile, 'w+');
	    }

	    fs.writeSync(fd, string);
	    createHtmlReport(reportFile);
	    console.log('json file location: ' + reportFile);
	});
};

this.registerListener(JsonFormatter);

}