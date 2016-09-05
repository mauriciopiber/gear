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

    this.Before({tags: ["@all-columns-db-unique-not-null-fixture"***REMOVED***}, function (scenario, callback) {

        var Q = require('q');
        Q.fcall(function() {

            return database.query(
                'insert into all_columns_db_unique_not_null set ?',
                {
                    id_all_columns_db_unique_not_null: '75',
                    varchar_password_verify_unique_not_null: '75VarcharPasswordVer',
                    varchar_upload_image_unique_not_null: '/upload/all-columns-db-unique-not-null-varcharUploadImageUniqueNotNull/pre75varcharUploadImageUniqueNotNull.gif',
                    varchar_url_unique_not_null: 'varchar.url.unique.not.null75.com.br',
                    varchar_varchar_unique_not_null: '75Varchar Varchar Unique Not Null',
                    varchar_unique_id_unique_not_null: '75Varchar Unique Unique Not Null',
                    varchar_telephone_unique_not_null: '(51) 9999-9975',
                    varchar_email_unique_not_null: 'varchar.email.unique.not.null75@gmail.com',
                    date_date_unique_not_null: '2006-03-15',
                    date_date_pt_br_unique_not_null: '2006-03-15',
                    datetime_datetime_unique_not_null: '2006-03-15 03:00:15',
                    datetime_datetime_pt_br_unique_not_null: '2006-03-15 03:00:15',
                    time_time_unique_not_null: '03:00:15',
                    decimal_decimal_unique_not_null: '75.75',
                    decimal_money_pt_br_unique_not_null: '75.75',
                    int_int_unique_not_null: '75',
                    int_checkbox_unique_not_null: '1',
                    id_int_foreign_key_unique_not_null: '15',
                    boolean_int_unique_not_null: '1',
                    boolean_checkbox_unique_not_null: '1',
                    text_text_unique_not_null: '75Text Text Unique Not Null',
                    text_html_unique_not_null: '75Text Html Unique Not Null',
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