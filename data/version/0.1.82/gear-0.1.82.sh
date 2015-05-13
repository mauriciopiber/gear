#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

php $index gear module unload BjyAuthorize

php $index gear module delete FreeMind
php $index gear module create FreeMind


php $index gear module src create FreeMind --type="Repository" --name="MyRepository"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryDependency"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryMultiDependency"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryExtends"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryDependencyExtends"
#php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryDependencyExtends"

#php $index gear module src create FreeMind --type="Service" --name="MyService"

#php $index gear module src create FreeMind --type="Repository" --name="ColumnsRepository" --db="Columns"

php $index gear database mysql dump /var/www/html/modules/module/FreeMind/data/ free-mind.mysql.sql

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
php $index gear module build FreeMind --trigger=phpcs
php $index gear module build FreeMind --trigger=phpmd
php $index gear module build FreeMind --trigger=phpcpd


