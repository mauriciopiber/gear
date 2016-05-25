#!/bin/bash

# MODULE
module=AppSrc
moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
gear="/var/www/gear-package/gear"
basePath="/var/www/gear-package"
modulePath="$basePath/$moduleUrl"
index="public/index.php"
#####################################################################################################################
echo "1. Criar Módulo"
cd $gear && sudo php public/index.php gear schema delete $module $basePath
rm -R $modulePath/config
rm -R $modulePath/src
rm -R $modulePath/test/unit
cd $gear && sudo php public/index.php gear module-as-project create $module $basePath

#####################################################################################################################
echo "2. Instalar Módulo"
cd $modulePath && sudo $modulePath/script/deploy-development.sh
##########################################################


cd $gear && sudo php public/index.php gear database mock Gear Module
cd $gear && sudo php public/index.php gear database analyse
cd $gear && sudo php public/index.php gear database analyse table Module 
cd $gear && sudo php public/index.php gear database fix
cd $gear && sudo php public/index.php gear database fix table Module
cd $gear && sudo php public/index.php gear database order
cd $gear && sudo php public/index.php gear database clear table Module
cd $gear && sudo php public/index.php gear database autoincrement
cd $gear && sudo php public/index.php gear database autoincrement table Module

exit 1


gear database load <location>
gear database dump <location> [<name>***REMOVED***
gear database module dump <module>
gear database project dump