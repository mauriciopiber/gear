#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

module=ColumnImage
moduleUrl="column-image"
#\"_not_null\": \"\"

datetimeptbr="\"upload_image_one\": \"upload-image\""
dateptbr="\"upload_image_two\": \"upload-image\""
decimalptbr="\"upload_image_three\": \"upload-image\""


columns="{$datetimeptbr, $dateptbr, $decimalptbr}"

#php $index gear module db create $module --table="ColumnsImage" --columns="$columns" --user=all

#php $index gear module db create $module --table="ColumnsImage" --columns="$columns" --user=all
#php $index gear module build $module --trigger=unit-set --domain=ColumnImageTest/ControllerTest
#exit 1

php $index gear module unload BjyAuthorize

php $index gear module delete $module
php $index gear module create $module
php $index gear module db create $module --table="ColumnsImage" --columns="$columns" --user=all
php $index gear module src create $module --type="Entity" --name="UploadImage" --db="UploadImage"




php $index gear project resetAcl
php $index gear project fixture --reset-autoincrement
php $index gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
php $index gear module load BjyAuthorize --before=ZfcBase
php $index gear database mysql dump /var/www/html/modules/module/$module/data/ $moduleUrl.mysql.sql

php $index gear module build $module --trigger=phpmd
php $index gear module build $module --trigger=phpcs
php $index gear module build $module --trigger=phpcpd
php $index gear module build $module --trigger=unit
php $index gear module build $module --trigger=acceptance
php $index gear module build $module --trigger=functional
exit 1
