#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

php $index gear module unload BjyAuthorize

php $index gear module delete FreeMind
php $index gear module create FreeMind

php $index gear module src create FreeMind --type="Entity" --name="Columns" --db="Columns"
php $index gear module src create FreeMind --type="Entity" --name="ForeignKeys" --db="ForeignKeys"
php $index gear module src create FreeMind --type="Fixture" --name="Columns" --db="Columns"
php $index gear module src create FreeMind --type="Fixture" --name="ForeignKeys" --db="ForeignKeys"
php $index gear module src create FreeMind --type="Repository" --name="ColumnsRepository" --db="Columns"

php $index gear module src create FreeMind --type="Service" --name="OtherService"
php $index gear module src create FreeMind --type="Service" --name="AnotherService"
php $index gear module src create FreeMind --type="Repository" --name="OtherRepository"

php $index gear module src create FreeMind --type="Repository" --name="MyRepository"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryDependency" --dependency="Service\OtherService"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryMultiDependency" --dependency="Service\OtherService,Service\AnotherService,Repository\OtherRepository"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryExtends" --extends="GearBase\AbstractBase"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryDependencyExtends" --extends="GearBase\AbstractBase" --dependency="Service\OtherService"

php $index gear project resetAcl
php $index gear project fixture --reset-autoincrement
php $index gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
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


#php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryDependencyExtends"

#php $index gear module src create FreeMind --type="Service" --name="MyService"

#php $index gear module src create FreeMind --type="Repository" --name="ColumnsRepository" --db="Columns"

php $index gear database mysql dump /var/www/html/modules/module/FreeMind/data/ free-mind.mysql.sql
php $index gear module build FreeMind --trigger=phpcs
php $index gear module build FreeMind --trigger=phpmd
php $index gear module build FreeMind --trigger=phpcpd
php $index gear module build FreeMind --trigger=unit-coverage
rm $base/public/freemind-coverage
ln -s $base/module/FreeMind/build/coverage/coverage $base/public/freemind-coverage
exit 1

php $index gear module src create FreeMind --type="Service" --name="MyService"
php $index gear module src create FreeMind --type="Service" --name="ColumnService" --db="Column"

php $index gear module src create FreeMind --type="Form" --name="MyRepository"
php $index gear module src create FreeMind --type="Filter" --name="MyFilter"
php $index gear module src create FreeMind --type="Entity" --name="MyEntity"
php $index gear module src create FreeMind --type="Factory" --name="MyFactory"
php $index gear module src create FreeMind --type="ValueObject" --name="MyValueObject"


php $index gear module src create FreeMind --type="Form" --name="ColumnRepository" --db="Column"
php $index gear module src create FreeMind --type="Filter" --name="ColumnFilter" --db="Column"
php $index gear module src create FreeMind --type="Entity" --name="ColumnEntity" --db="Column"
php $index gear module src create FreeMind --type="Factory" --name="ColumnFactory" --db="Column"
php $index gear module src create FreeMind --type="ValueObject" --name="ColumnValueObject" --db="Column"

php $index gear database mysql dump /var/www/html/modules/module/FreeMind/data/ free-mind.mysql.sql

php $index gear module build FreeMind --trigger=unit-coverage
exit 1


