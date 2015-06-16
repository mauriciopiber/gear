#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

module=TrendAdmin
moduleUrl="trend-admin"



exit 1

php $index gear module unload BjyAuthorize
php $index gear module delete $module
php $index gear module create $module

php $index gear module src create $module --name="Legenda" --type="Entity" --db="Legenda"
php $index gear module src create $module --name="Legenda" --type="Fixture" --db="Legenda"
php $index gear module src create $module --name="TipoProduto" --type="Entity" --db="TipoProduto"
php $index gear module src create $module --name="TipoProduto" --type="Fixture" --db="TipoProduto"
php $index gear module src create $module --name="UploadImage" --type="Entity" --db="UploadImage"

php $index gear module src create $module --name="ProdutoLegenda" --type="Entity" --db="ProdutoLegenda"
php $index gear module src create $module --name="ProdutoLegenda" --type="Fixture" --db="ProdutoLegenda"
php $index gear module src create $module --name="ProdutoLegendaService" --type="Service" --db="ProdutoLegenda" --dependency="Repository\ProdutoLegenda"
php $index gear module src create $module --name="ProdutoLegendaRepository" --type="Repository" --db="ProdutoLegenda"

imagem="\"imagem\": \"upload-image\""
valor="\"valor\": \"money-pt-br\""
columnsMarca="{$imagem}"
columnsProduto="{$valor}"

php $index gear module db create $module --table="Marca" --columns="$columnsMarca"
php $index gear module db create $module --table="Produto" --columns="$columnsProduto"

exit 1
php $index gear cache renew --data
php $index gear cache renew --memcached
php $index gear project fixture --reset-autoincrement
php $index gear project setUpAcl
php $index gear database mysql dump /var/www/html/modules/module/$module/data/ $moduleUrl.mysql.sql

php $index gear module load BjyAuthorize --before=ZfcBase
php $index gear cache renew --data
php $index gear cache renew --memcached

php $index gear module build $module --trigger=phpunit
#php $index gear module build $module --trigger=acceptance
#php $index gear module build $module --trigger=functional
#php $index gear module build $module --trigger=phpcs
#php $index gear module build $module --trigger=phpmd
#php $index gear module build $module --trigger=phpcpd