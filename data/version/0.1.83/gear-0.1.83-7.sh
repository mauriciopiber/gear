#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

module=Addon
moduleUrl=addon

php $index gear module unload BjyAuthorize

php $index gear module delete $module
php $index gear module create $module
php $index gear module db create $module --table="Columns"
php $index gear module src create $module --type="Entity" --name="ForeignKeys" --db="ForeignKeys"
php $index gear module src create $module --type="Fixture" --name="ForeignKeys" --db="ForeignKeys"

php $index gear module activity create $module ColumnsController --name="report"

php $index gear project resetAcl
php $index gear project fixture --reset-autoincrement
php $index gear project setUpAcl
php $index gear cache renew --data --memcached
php $index gear module load BjyAuthorize --before=ZfcBase

php $index gear database mysql dump /var/www/html/modules/module/$module/data/ $moduleUrl.mysql.sql

php $index gear module build $module --trigger=acceptance-set --domain="ColumnsCreateCest"
php $index gear module build $module --trigger=functional-set --domain="ColumnsCreateCest"
php $index gear module build $module --trigger=unit-set --domain=AddonTest/ControllerTest
php $index gear module build $module --trigger=phpmd
php $index gear module build $module --trigger=phpcs
php $index gear module build $module --trigger=phpcpd

exit 1
#php $index gear module build $module --trigger=acceptance
#php $index gear module build $module --trigger=functional
#php $index gear module build $module --trigger=phpcs
#php $index gear module build $module --trigger=phpmd
#php $index gear module build $module --trigger=phpcpd
exit 1

#php $index gear module controller create $module --name="Gremio" --object="%s\Controller\Gremio"
#php $index gear module controller create $module --name="SaoPaulo" --object="%s\Controller\SaoPaulo"
#php $index gear module controller create $module --name="Palmeiras" --object="%s\Controller\Palmeiras"
#php $index gear module controller create $module --name="Corinthians" --object="%s\Controller\Corinthians"



exit 0



