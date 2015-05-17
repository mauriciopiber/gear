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
php $index gear module activity create $module Internacional --name="CampeaoDoMundo"
php $index gear cache renew --memcached --data
php $index gear project setUpAcl
php $index gear module build $module --trigger=unit
php $index gear module build $module --trigger=phpcs
php $index gear module build $module --trigger=phpmd
php $index gear module build $module --trigger=phpcpd
exit 1
php $index gear module activity create $module Internacional --name="BiLibertadores"
php $index gear module activity create $module Internacional --name="TriBrasileiro"
php $index gear module activity create $module Internacional --name="TetraGaucho"
php $index gear module activity create $module Internacional --name="OctaGaucho"
#php $index gear module controller create $module --name="Gremio" --object="%s\Controller\Gremio"
#php $index gear module controller create $module --name="SaoPaulo" --object="%s\Controller\SaoPaulo"
#php $index gear module controller create $module --name="Palmeiras" --object="%s\Controller\Palmeiras"
#php $index gear module controller create $module --name="Corinthians" --object="%s\Controller\Corinthians"

php $index gear module build $module --trigger=phpcs
php $index gear module build $module --trigger=phpmd
php $index gear module build $module --trigger=phpcpd


exit 0

php $index gear module controller create $module --name="Gremio" --object="%s\Controller\Gremio"
php $index gear module controller create $module --name="SaoPaulo" --object="%s\Controller\SaoPaulo"

