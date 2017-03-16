#!/bin/bash

# MODULE
module=AllColumns
moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
gear="/var/www/gear-package/gear"
basePath="/var/www/gear-package"
modulePath="$basePath/$moduleUrl"
index="public/index.php"

rm -R $modulePath/config
rm -R $modulePath/src
rm -R $modulePath/test/unit
rm -R $modulePath/view

#####################################################################################################################
echo "1. Criar Módulo"
cd $gear && sudo php public/index.php gear schema delete $module $basePath
cd $gear && sudo php public/index.php gear module-as-project create $module $basePath


#####################################################################################################################
echo "2. Instalar Módulo"
cd $modulePath && sudo $modulePath/script/deploy-development.sh
#####################################################################################################################

cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MyTest/MyAaaaUnitTest.php
cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MySecond/MyBaaaUnitTest.php
cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MyCaaaUnitTest.php
cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MyDaaaUnitTest.php

#####################################################################################################################
echo "4. Configuração"
cd $modulePath && sudo $modulePath/script/load.sh 
#####################################################################################################################
echo "5. Teste"
cd $modulePath && ant dev

exit 1
