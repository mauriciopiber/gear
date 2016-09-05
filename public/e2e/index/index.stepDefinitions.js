var fs = require('fs-extra');
var path = require('path');

var basepath = null;

var tryModule = path.join(__dirname, '../../../../../vendor/mauriciopiber/gear-admin');
var tryProject = path.join(__dirname, '../../../../../../../vendor/mauriciopiber/gear-admin');

if (!fs.existsSync(tryModule) && !fs.existsSync(tryProject)) {

    if (basepath == null) {
        throw new Error('Can\'t found basepath of support files');
    }
}

basepath = (fs.existsSync(tryModule)) ? tryModule : null;
basepath = (basepath == null && fs.existsSync(tryProject)) ? tryProject : basepath;

var expect = require(basepath + '/public/js/spec/e2e/support/expect/expect');
var login = require(basepath + '/public/js/spec/e2e/login/login.page.js');
var indexPage = require('./index.page.js');

module.exports = function () {

    this.Given(/^eu clico no menu My Module$/, function (callback) {
        browser.get('/my-module').then(function() {
            callback();
        });
    });
};