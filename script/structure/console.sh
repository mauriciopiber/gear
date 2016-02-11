#!/bin/bash

# MODULE
module=ConsoleApp
moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
gear="/var/www/gear-package/gear"
basePath="/var/www/gear-package"
modulePath="$basePath/$moduleUrl"
index="public/index.php"
#####################################################################################################################
echo "1. Criar Módulo"
cd $gear && sudo php public/index.php gear schema delete $module $basePath
cd $gear && sudo php public/index.php gear module-as-project create $module $basePath

#####################################################################################################################
echo "2. Instalar Módulo"
cd $modulePath && sudo $modulePath/script/deploy-development.sh
#####################################################################################################################


cd $gear && sudo php $index gear module controller create $module $basePath --name="Database"

exit 1

cd $gear && sudo php $index gear module activity create $module $basePath Database --name="Load"
cd $gear && sudo php $index gear module activity create $module $basePath Database --name="Dump"
cd $gear && sudo php $index gear module activity create $module $basePath Database --name="CreateTable"
cat $modulePath/src/ConsoleApp/Controller/Database.php
cat $modulePath/test/unit/ConsoleAppTest/ControllerTest/DatabaseTest.php
cd $gear && sudo php $index gear module controller create $module $basePath --name="Module" --type="Console"
cat $modulePath/src/ConsoleApp/Controller/Module.php
cd $gear && sudo php $index gear module activity create $module $basePath Module --name="CriarModulo"
cat $modulePath/src/ConsoleApp/Controller/Module.php

exit 1

cd $gear && sudo php $index gear module activity create $module $basePath Module --name="DeletarModulo"
cat $modulePath/src/ConsoleApp/Controller/Module.php
cat $modulePath/test/unit//ConsoleAppTest/ControllerTest/ModuleTest.php
cat $modulePath/config/ext/controller.config.php
#cat $modulePath/schema/module.json
exit 1

 




exit 1

cd $gear && sudo php $index gear module controller create $module $basePath --name="Project" --type="Console"
cd $gear && sudo php $index gear module activity create $module $basePath Project --name="CriarProjeto"
cd $gear && sudo php $index gear module activity create $module $basePath Project --name="DeletarProjeto"



cd $modulePath && ant dev