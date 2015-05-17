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
php $index gear module activity create $module Internacional --name="BiLibertadores"
php $index gear module activity create $module Internacional --name="TriBrasileiro"
php $index gear module activity create $module Internacional --name="TetraGaucho"
php $index gear module activity create $module Internacional --name="OctaGaucho"

php $index gear module controller create $module --name="Gremio" --object="%s\Controller\Gremio"
php $index gear module activity create $module Gremio --name="CampeaoDoMundo"
php $index gear module activity create $module Gremio --name="BiLibertadores"
php $index gear module activity create $module Gremio --name="Brasileiro"
php $index gear module activity create $module Gremio --name="HeptaGaucho"

php $index gear module controller create $module --name="SaoPaulo" --object="%s\Controller\SaoPaulo"
php $index gear module activity create $module SaoPaulo --name="TriCampeaoDoMundo"
php $index gear module activity create $module SaoPaulo --name="TriLibertadores"
php $index gear module activity create $module SaoPaulo --name="HexaBrasileiro"

php $index gear module controller create $module --name="Corinthians" --object="%s\Controller\Corinthians"
php $index gear module activity create $module Corinthians --name="CampeaoDoMundo"
php $index gear module activity create $module Corinthians --name="Libertadores"
php $index gear module activity create $module Corinthians --name="TetraBrasileiro"

php $index gear cache renew --memcached --data
php $index gear project setUpAcl
php $index gear cache renew --memcached --data
php $index gear module build $module --trigger=acceptance
php $index gear module build $module --trigger=functional
#php $index gear module build $module --trigger=phpcs
#php $index gear module build $module --trigger=phpmd
#php $index gear module build $module --trigger=phpcpd
exit 1

#php $index gear module controller create $module --name="Gremio" --object="%s\Controller\Gremio"
#php $index gear module controller create $module --name="SaoPaulo" --object="%s\Controller\SaoPaulo"
#php $index gear module controller create $module --name="Palmeiras" --object="%s\Controller\Palmeiras"
#php $index gear module controller create $module --name="Corinthians" --object="%s\Controller\Corinthians"

php $index gear module build $module --trigger=phpcs
php $index gear module build $module --trigger=phpmd
php $index gear module build $module --trigger=phpcpd


exit 0



