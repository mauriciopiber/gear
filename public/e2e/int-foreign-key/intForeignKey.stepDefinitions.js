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

var database = require(basepath + '/public/js/spec/e2e/support/database/database.js');
var memcached = require(basepath + '/public/js/spec/e2e/support/memcached/memcached.js');

module.exports = function () {

    this.Before({tags: ["@int-foreign-key-fixture"***REMOVED***}, function (scenario, callback) {

        var Q = require('q');
        Q.fcall(function() {

            return database.query(
                'insert into int_foreign_key set ?',
                {
                    id_int_foreign_key: '75',
                    dep_name: '75Dep Name',
                    created: '2016-12-01 01:00:00',
                    updated: null,
                    created_by: 1,
                    updated_by: null
                }
            );
        }).then(function(text) {
            memcached.flush();
        }).then(function() {
            callback();
        });
    });
};