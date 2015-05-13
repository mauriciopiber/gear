#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

php $index gear module unload BjyAuthorize

php $index gear module delete FreeMind
php $index gear module create FreeMind


###################
####### SRC #######
###################

php $index gear module src create FreeMind --type="Form" --name="MyForm"
php $index gear module src create FreeMind --type="Form" --name="MyFormDependency" --dependency="Service\OtherService"
php $index gear module src create FreeMind --type="Form" --name="MyFormMultiDependency" --dependency="Service\OtherService,Service\AnotherService,Repository\OtherRepository"
php $index gear module src create FreeMind --type="Form" --name="MyFormExtends" --extends="GearBase\AbstractBase"
php $index gear module src create FreeMind --type="Form" --name="MyFormDependencyExtends" --extends="GearBase\AbstractBase" --dependency="Service\OtherService"

php $index gear module src create FreeMind --type="Filter" --name="MyFilter"
php $index gear module src create FreeMind --type="Filter" --name="MyFilterDependency" --dependency="Service\OtherService"
php $index gear module src create FreeMind --type="Filter" --name="MyFilterMultiDependency" --dependency="Service\OtherService,Service\AnotherService,Repository\OtherRepository"
php $index gear module src create FreeMind --type="Filter" --name="MyFilterExtends" --extends="GearBase\AbstractBase"
php $index gear module src create FreeMind --type="Filter" --name="MyFilterDependencyExtends" --extends="GearBase\AbstractBase" --dependency="Service\OtherService"

php $index gear database mysql dump /var/www/html/modules/module/FreeMind/data/ free-mind.mysql.sql

php $index gear module build FreeMind --trigger=unit-coverage

exit 1

php $index gear module src create FreeMind --type="Service" --name="OtherService"
php $index gear module src create FreeMind --type="Service" --name="AnotherService"
php $index gear module src create FreeMind --type="Repository" --name="OtherRepository"

php $index gear module src create FreeMind --type="Repository" --name="MyRepository"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryDependency" --dependency="Service\OtherService"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryMultiDependency" --dependency="Service\OtherService,Service\AnotherService,Repository\OtherRepository"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryExtends" --extends="GearBase\AbstractBase"
php $index gear module src create FreeMind --type="Repository" --name="MyRepositoryDependencyExtends" --extends="GearBase\AbstractBase" --dependency="Service\OtherService"

php $index gear module src create FreeMind --type="Service" --name="MyService"
php $index gear module src create FreeMind --type="Service" --name="MyServiceDependency" --dependency="Service\OtherService"
php $index gear module src create FreeMind --type="Service" --name="MyServiceMultiDependency" --dependency="Service\OtherService,Service\AnotherService,Repository\OtherRepository"
php $index gear module src create FreeMind --type="Service" --name="MyServiceExtends" --extends="GearBase\AbstractBase"
php $index gear module src create FreeMind --type="Service" --name="MyServiceDependencyExtends" --extends="GearBase\AbstractBase" --dependency="Service\OtherService"

php $index gear database mysql dump /var/www/html/modules/module/FreeMind/data/ free-mind.mysql.sql

php $index gear module build FreeMind --trigger=unit
php $index gear module build FreeMind --trigger=phpcs
php $index gear module build FreeMind --trigger=phpmd
php $index gear module build FreeMind --trigger=phpcpd
php $index gear module build FreeMind --trigger=unit-coverage
rm $base/public/freemind-coverage
ln -s $base/module/FreeMind/build/coverage/coverage $base/public/freemind-coverage
exit 1



