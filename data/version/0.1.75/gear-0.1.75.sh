#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

module=ColumnNotNull
moduleUrl="column-not-null"
#\"_not_null\": \"\"

datetimeptbr="\"column_datetime_pt_br_not_null_not_null\": \"datetime-pt-br\""
dateptbr="\"column_date_pt_br_not_null\": \"date-pt-br\""
decimalptbr="\"column_decimal_pt_br_not_null\": \"money-pt-br\""
intcheckbox="\"column_int_checkbox_not_null\": \"checkbox\""
tinyintcheckbox="\"column_tinyint_checkbox_not_null\": \"checkbox\""
varcharemail="\"column_varchar_email_not_null\": \"email\""
varcharpasswordverify="\"column_varchar_password_verify_not_null\": \"password-verify\""
varcharimageupload="\"column_varchar_upload_image_not_null\": \"upload-image\""
varcharuniqueid="\"column_varchar_unique_id_not_null\": \"unique-id\""

columns="{$datetimeptbr, $dateptbr, $decimalptbr, $intcheckbox, $tinyintcheckbox, $varcharemail, $varcharpasswordverify, $varcharimageupload, $varcharuniqueid}"

#php $index gear module unload BjyAuthorize

#php $index gear module delete $module

#php $index gear module create $module

php $index gear module db create $module --table="ColumnsNotNull" --columns="$columns"
#php $index gear module db create $module --table="ForeignKeys" --user=strict

#php $index gear project resetAcl

#php $index gear project fixture --reset-autoincrement

#php $index gear project setUpAcl


#/usr/bin/expect ./script/utils/clear-memcached.sh
#php $index gear module load BjyAuthorize --before=ZfcBase

#php $index gear database mysql dump /var/www/html/modules/module/$module/data/ $moduleUrl.mysql.sql

#php $index gear module build $module --trigger=phpmd
php $index gear module build $module --trigger=unit

exit 1
php $index gear module build $module --trigger=acceptance
php $index gear module build $module --trigger=functional
php $index gear module build $module --trigger=phpmd
php $index gear module build $module --trigger=phpcs
php $index gear module build $module --trigger=phpcpd


exit 1

#php $index gear module build $module  --trigger=acceptance-set --domain=ColumnsListCest
#php $index gear module build $module --trigger=unit

#phpunit-group --domain=Repository

#php $index gear module build $module --trigger=phpmd
#php $index gear module build $module --trigger=phpcs
#php $index gear module build $module --trigger=phpcpd
#php $index gear module build $module --trigger=phpunit
#php $index gear module build $module --trigger=acceptance
#php $index gear module build $module --trigger=functional
