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

cd $gear && sudo php $index gear module view create $module $basePath --target=extra/first1.phtml
cd $gear && sudo php $index gear module view create $module $basePath --target=extra/first2.phtml
cd $gear && sudo php $index gear module view create $module $basePath --target=extra/first3.phtml
cd $gear && sudo php $index gear module view create $module $basePath --target=extra/first4.phtml
cd $gear && sudo php $index gear module view create $module $basePath --target=extra/first5.phtml


#####################################################################################################################
echo "4. Configuração"
cd $modulePath && sudo $modulePath/script/load.sh 
#####################################################################################################################
echo "5. Teste"
cd $modulePath && ant dev

exit 1
