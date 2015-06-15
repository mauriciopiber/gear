#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

module=TrendAdmin
moduleUrl="trend-admin"

php $index gear module unload TrendNatural
php $index gear module unload BjyAuthorize

php $index gear module delete $module
php $index gear module create $module

php $index gear module db create $module --table="Segmento"

php $index gear cache renew --data
php $index gear cache renew --memcached
php $index gear project fixture --reset-autoincrement
php $index gear database mysql dump /var/www/html/modules/module/$module/data/ $moduleUrl.mysql.sql

php $index gear module build $module --trigger=phpunit
php $index gear module build $module --trigger=acceptance
php $index gear module build $module --trigger=functional
php $index gear module build $module --trigger=phpcs
php $index gear module build $module --trigger=phpmd
php $index gear module build $module --trigger=phpcpd

columns="{\"email\" : \"email\", \"password\" : \"password-verify\", \"uid\" : \"unique-id\", \"state\" : \"checkbox\"}"

php $index gear module db create $module --table="User" --columns="$columns"
php $index gear module db create $module --table="Cliente"
#php $index gear module db create $module --table="Vendedor"

php $index gear module src create $module --name="Role" --type="Entity" --db="Role"
php $index gear module src create $module --name="Role" --type="Fixture" --db="Role"

php $index gear cache renew --data
php $index gear cache renew --memcached
php $index gear project fixture --reset-autoincrement
php $index gear database mysql dump /var/www/html/modules/module/$module/data/ $moduleUrl.mysql.sql

php $index gear module build $module --trigger=phpunit
php $index gear module build $module --trigger=acceptance
php $index gear module build $module --trigger=functional
php $index gear module build $module --trigger=phpcs
php $index gear module build $module --trigger=phpmd
php $index gear module build $module --trigger=phpcpd

#php $index gear module src create $module --name="User" --type="Entity" --db="User"
#php $index gear module src create $module --name="User" --type="Fixture" --db="User"


