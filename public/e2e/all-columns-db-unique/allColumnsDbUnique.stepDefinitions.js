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

    this.Before({tags: ["@all-columns-db-unique-fixture"***REMOVED***}, function (scenario, callback) {

        var Q = require('q');
        Q.fcall(function() {

            return database.query(
                'insert into all_columns_db_unique set ?',
                {
                    id_all_columns_db_unique: '75',
                    varchar_password_verify_unique: '75VarcharPasswordVer',
                    varchar_upload_image_unique: '/upload/all-columns-db-unique-varcharUploadImageUnique/pre75varcharUploadImageUnique.gif',
                    varchar_url_unique: 'varchar.url.unique75.com.br',
                    varchar_varchar_unique: '75Varchar Varchar Unique',
                    varchar_unique_id_unique: '75Varchar Unique Unique',
                    varchar_telephone_unique: '(51) 9999-9975',
                    varchar_email_unique: 'varchar.email.unique75@gmail.com',
                    date_date_unique: '2006-03-15',
                    date_date_pt_br_unique: '2006-03-15',
                    datetime_datetime_unique: '2006-03-15 03:00:15',
                    datetime_datetime_pt_br_unique: '2006-03-15 03:00:15',
                    time_time_unique: '03:00:15',
                    decimal_decimal_unique: '75.75',
                    decimal_money_pt_br_unique: '75.75',
                    int_int_unique: '75',
                    int_checkbox_unique: '1',
                    id_int_foreign_key_unique: '15',
                    boolean_int_unique: '1',
                    boolean_checkbox_unique: '1',
                    text_text_unique: '75Text Text Unique',
                    text_html_unique: '75Text Html Unique',
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