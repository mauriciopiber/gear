#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"
#\"\": \"\"

module=TestUpload

varcharimageupload="\"image\": \"upload-image\""


columns="{$varcharimageupload}"

php $index gear module unload BjyAuthorize

php $index gear module delete TestUpload

php $index gear module create $module

php $index gear module db create $module --table="TestUploadImage" --columns="$columns"


#php $index gear src create Column --type="Entity" --name="User" --db="User"
#php $index gear src create Column --type="Entity" --name="Role" --db="Role"
#php $index gear src create Column --type="Fixture" --name="User" --db="User"
#php $index gear src create Column --type="Fixture" --name="Role" --db="Role"

php $index gear project resetAcl
php $index gear project fixture --reset-autoincrement
php $index gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
php $index gear module load BjyAuthorize --before=ZfcBase

php $index gear database mysql dump /var/www/html/modules/module/$module/data/ test-upload.mysql.sql

#php $index gear module build Column --trigger=phpunit-group --domain=Repository
#php $index gear module build Teste --trigger=phpunit