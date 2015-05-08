#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"


#preparando projeto
php $index gear module unload BjyAuthorize


#modulo 1
module=Standard
moduleUrl="standard"
php $index gear module delete $module
php $index gear module create $module
php $index gear module db create $module --table="ColumnsStandard"
php $index gear module db create $module --table="ColumnsStandardUploadImage"
php $index gear module src create $module --type="Entity" --name="UploadImage" --db="UploadImage"
php $index gear module src create $module --type="Entity" --name="ColumnsImage" --db="ColumnsImage"
php $index gear module src create $module --type="Entity" --name="ForeignKeys" --db="ForeignKeys"
php $index gear module src create $module --type="Fixture" --name="ForeignKeys" --db="ForeignKeys"
#modulo 2

#modulo 3


#projeto
php $index gear project resetAcl
php $index gear project fixture --reset-autoincrement
php $index gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
php $index gear module load BjyAuthorize --before=ZfcBase
php $index gear database mysql dump /var/www/html/modules/module/$module/data/ $moduleUrl.mysql.sql


#module 1 - build
#module 2 - build
#module 3 - build

php $index gear module build $module --trigger=phpmd
php $index gear module build $module --trigger=phpcs
php $index gear module build $module --trigger=phpcpd
php $index gear module build $module --trigger=unit
php $index gear module build $module --trigger=acceptance
php $index gear module build $module --trigger=functional
exit 1
