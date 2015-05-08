#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"


#preparando projeto
php $index gear module unload BjyAuthorize


moduleOne=Column
moduleOneUrl=column
moduleTwo=ColumnNotNull
moduleTwoUrl=column-not-null
moduleThree=ColumnImage
moduleThreeUrl=column-image

#modulo 1
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

php $index gear module delete $moduleOne
php $index gear module create $moduleOne
php $index gear module db create $moduleOne --table="Columns" --columns="$columns" --user=all
php $index gear module db create $moduleOne --table="ForeignKeys" --user=strict
#modulo 2
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

php $index gear module delete $moduleTwo
php $index gear module create $moduleTwo
php $index gear module db create $moduleTwo --table="ColumnsNotNull" --columns="$columns" --user=strict
php $index gear module db create $moduleTwo --table="ForeignKeys" --user=strict
sudo rm $base/module/$moduleTwo/src/$moduleTwo/Fixture/ForeignKeysFixture.php
#modulo 3

datetimeptbr="\"upload_image_one\": \"upload-image\""
dateptbr="\"upload_image_two\": \"upload-image\""
decimalptbr="\"upload_image_three\": \"upload-image\""


columns="{$datetimeptbr, $dateptbr, $decimalptbr}"

php $index gear module delete $moduleThree
php $index gear module create $moduleThree
php $index gear module db create $moduleThree --table="ColumnsImage" --columns="$columns" --user=all
php $index gear module src create $moduleThree --type="Entity" --name="UploadImage" --db="UploadImage"
php $index gear module src create $moduleThree --type="Entity" --name="ColumnsStandardUploadImage" --db="ColumnsStandardUploadImage"

#projeto
php $index gear project resetAcl
php $index gear project fixture --reset-autoincrement
php $index gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
php $index gear module load BjyAuthorize --before=ZfcBase

php $index gear database mysql dump /var/www/html/modules/module/$moduleOne/data/ $moduleOneUrl.mysql.sql
php $index gear database mysql dump /var/www/html/modules/module/$moduleTwo/data/ $moduleTwoUrl.mysql.sql
php $index gear database mysql dump /var/www/html/modules/module/$moduleThree/data/ $moduleThreeUrl.mysql.sql

#module 1 - build
#module 2 - build
#module 3 - build

php $index gear module build $moduleOne --trigger=phpmd
php $index gear module build $moduleOne --trigger=phpcs
php $index gear module build $moduleOne --trigger=phpcpd
php $index gear module build $moduleOne --trigger=unit
php $index gear module build $moduleOne --trigger=acceptance
php $index gear module build $moduleOne --trigger=functional
php $index gear module build $moduleTwo --trigger=phpmd
php $index gear module build $moduleTwo --trigger=phpcs
php $index gear module build $moduleTwo --trigger=phpcpd
php $index gear module build $moduleTwo --trigger=unit
php $index gear module build $moduleTwo --trigger=acceptance
php $index gear module build $moduleTwo --trigger=functional
php $index gear module build $moduleThree --trigger=phpmd
php $index gear module build $moduleThree --trigger=phpcs
php $index gear module build $moduleThree --trigger=phpcpd
php $index gear module build $moduleThree --trigger=unit
php $index gear module build $moduleThree --trigger=acceptance
php $index gear module build $moduleThree --trigger=functional
exit 1
