#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

module=Controllers

php $index gear module delete $module
php $index gear module create $module

php $index gear project setUpAcl
php $index gear database mysql dump /var/www/html/modules/module/$module/data/ controllers.mysql.sql
php $index gear cache renew --memcached --data

php $index gear module controller create $module --name="Internacional" --object="%s\Controller\Internacional"
php $index gear module build $module --trigger=codeception

exit 0

php $index gear module controller create $module --name="Gremio" --object="%s\Controller\Gremio"
php $index gear module controller create $module --name="SaoPaulo" --object="%s\Controller\SaoPaulo"

