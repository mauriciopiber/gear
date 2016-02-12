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
rm -R $modulePath/src
rm -R $modulePath/test/unit
cd $gear && sudo php public/index.php gear module-as-project create $module $basePath


#####################################################################################################################
echo "2. Instalar Módulo"
cd $modulePath && sudo $modulePath/script/deploy-development.sh
#####################################################################################################################

## Comando Mínimo
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoService" --type="Service" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoRepository" --type="Repository" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoForm" --type="Form" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFilter" --type="Filter" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFactory" --type="Factory" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoValueObject" --type="ValueObject" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoControllerPlugin" --type="ControllerPlugin" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoViewHelper" --type="ViewHelper" --namespace="Minimo"
ls -l $modulePath/src/$module/Minimo
cd $modulePath && ant unit

exit 1
## OK OK OK OK OK 
## Comando Mínimo
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoRepository" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoForm" --type="Form"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFilter" --type="Filter"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFactory" --type="Factory"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoValueObject" --type="ValueObject"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoControllerPlugin" --type="ControllerPlugin"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoViewHelper" --type="ViewHelper"
cd $modulePath && ant unit-coverage

exit 1





exit 1

#cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFixture" --type="Fixture"
#cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoEntity" --type="Entity"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FirstService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SecondService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ThirdService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FirstRepository" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SecondRepository" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ThirdRepository" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FirstForm" --type="Form"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SecondForm" --type="Form"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ThirdForm" --type="Form"

#####################################################################################################################
echo "4. Configuração"
cd $modulePath && sudo $modulePath/script/load.sh 
#####################################################################################################################
echo "5. Teste"
cd $modulePath && ant dev
#dev