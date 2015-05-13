#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

php $index gear module unload BjyAuthorize

php $index gear module delete FreeMind
php $index gear module create FreeMind

################
###### DB ######
################
php $index gear module src create FreeMind --type="Entity" --name="Columns" --db="Columns"
php $index gear module src create FreeMind --type="Entity" --name="ForeignKeys" --db="ForeignKeys"
php $index gear module src create FreeMind --type="Fixture" --name="Columns" --db="Columns"
php $index gear module src create FreeMind --type="Fixture" --name="ForeignKeys" --db="ForeignKeys"
php $index gear module src create FreeMind --type="Repository" --name="ColumnsRepository" --db="Columns"
php $index gear module src create FreeMind --type="Service" --name="ColumnsService" --db="Columns" --dependency="Repository\Columns"

php $index gear project resetAcl
php $index gear project fixture --reset-autoincrement
php $index gear project setUpAcl
php $index gear cache renew --memcached
php $index gear module load BjyAuthorize --before=ZfcBase

php $index gear database mysql dump /var/www/html/modules/module/FreeMind/data/ free-mind.mysql.sql
php $index gear module build FreeMind --trigger=unit
php $index gear module build FreeMind --trigger=phpcs
php $index gear module build FreeMind --trigger=phpmd
php $index gear module build FreeMind --trigger=phpcpd
php $index gear module build FreeMind --trigger=unit-coverage
rm $base/public/freemind-coverage
ln -s $base/module/FreeMind/build/coverage/coverage $base/public/freemind-coverage
exit 1



