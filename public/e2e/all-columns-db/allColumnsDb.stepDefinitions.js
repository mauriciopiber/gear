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

    this.Before({tags: ["@all-columns-db-fixture"***REMOVED***}, function (scenario, callback) {

        var Q = require('q');
        Q.fcall(function() {

            return database.query(
                'insert into all_columns_db set ?',
                {
                    id_all_columns_db: '75',
                    varchar_password_verify: '75VarcharPasswordVer',
                    varchar_upload_image: '/upload/all-columns-db-varcharUploadImage/pre75varcharUploadImage.gif',
                    varchar_url: 'varchar.url75.com.br',
                    varchar_varchar: '75Varchar Varchar',
                    varchar_unique_id: '75Varchar Unique',
                    varchar_telephone: '(51) 9999-9975',
                    varchar_email: 'varchar.email75@gmail.com',
                    date_date: '2006-03-15',
                    date_date_pt_br: '2006-03-15',
                    datetime_datetime: '2006-03-15 03:00:15',
                    datetime_datetime_pt_br: '2006-03-15 03:00:15',
                    time_time: '03:00:15',
                    decimal_decimal: '75.75',
                    decimal_money_pt_br: '75.75',
                    int_int: '75',
                    int_checkbox: '1',
                    id_int_foreign_key: '15',
                    boolean_int: '1',
                    boolean_checkbox: '1',
                    text_text: '75Text Text',
                    text_html: '75Text Html',
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