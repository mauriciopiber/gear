#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"
#\"\": \"\"

datetimeptbr="\"column_datetime_pt_br\": \"datetime-pt-br\""
dateptbr="\"column_date_pt_br\": \"date-pt-br\""
decimalptbr="\"column_decimal_pt_br\": \"money-pt-br\""
intcheckbox="\"column_int_checkbox\": \"checkbox\""
tinyintcheckbox="\"column_tinyint_checkbox\": \"checkbox\""
varcharemail="\"column_varchar_email\": \"email\""
varcharpasswordverify="\"column_varchar_password_verify\": \"password-verify\""
varcharimageupload="\"column_varchar_upload_image\": \"upload-image\""
varcharuniqueid="\"column_varchar_unique_id\": \"unique-id\""

columns="{$datetimeptbr, $dateptbr, $decimalptbr, $intcheckbox, $tinyintcheckbox, $varcharemail, $varcharpasswordverify, $varcharimageupload, $varcharuniqueid}"

php $index gear module unload BjyAuthorize

php $index gear module delete Column

php $index gear module create Column

php $index gear module db create Column --table="Columns" --columns="$columns" --user=strict
php $index gear module db create Column --table="ForeignKeys" --user=strict

php $index gear project resetAcl
php $index gear project fixture --reset-autoincrement
php $index gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
php $index gear module load BjyAuthorize --before=ZfcBase

php $index gear database mysql dump /var/www/html/modules/module/Column/data/ column.mysql.sql


php $index gear module build Column  --trigger=functional-set --domain=ColumnsListCest
exit 1
phpunit-group --domain=Repository

php $index gear module build Column --trigger=phpmd
php $index gear module build Column --trigger=phpcs
php $index gear module build Column --trigger=phpcpd
php $index gear module build Column --trigger=phpunit
php $index gear module build Column --trigger=acceptance
php $index gear module build Column --trigger=functional
