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
#####################################################################################################################

#cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoService" --type="Service" --namespace="Minimo" --service=factory

#cd $modulePath && ant dev
#cat $modulePath/schema/module.json
#cat $modulePath/config/ext/servicemanager.config.php

#exit


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Service001" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Service002" --type="Service" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Service003" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Service004" --type="Service" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Service005" --type="Service"  

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFactory001" --type="Service" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFactory002" --type="Service" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFactory003" --type="Service" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFactory004" --type="Service" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFactory005" --type="Service" --service="factories"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFactoryNamespace001" --type="Service" --service="factories" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFactoryNamespace002" --type="Service" --service="factories" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFactoryNamespace003" --type="Service" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFactoryNamespace004" --type="Service" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFactoryNamespace005" --type="Service" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceNamespace001" --type="Service" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceNamespace002" --type="Service" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceNamespace003" --type="Service" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceNamespace004" --type="Service" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceNamespace005" --type="Service" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFacDepNam001" --type="Service" --service=factories --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFacDepNam002" --type="Service" --service=factories --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\ServiceFacDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFacDepNam003" --type="Service" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\ServiceFacDepNam001,Namespace1\\Namespace2\\ServiceFacDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFacDepNam004" --type="Service" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\ServiceFacDepNam001,Namespace1\\Namespace2\\ServiceFacDepNam002,Namespace1\\Namespace2\\Namespace3\\ServiceFacDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceFacDepNam005" --type="Service" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\ServiceFacDepNam001,Namespace1\\Namespace2\\ServiceFacDepNam002,Namespace1\\Namespace2\\Namespace3\\ServiceFacDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\ServiceFacDepNam004"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceDepNam001" --type="Service" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceDepNam002" --type="Service" --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\ServiceDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceDepNam003" --type="Service" --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\ServiceDepNam001,Namespace1\\Namespace2\\ServiceDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceDepNam004" --type="Service" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\ServiceDepNam001,Namespace1\\Namespace2\\ServiceDepNam002,Namespace1\\Namespace2\\Namespace3\\ServiceDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceDepNam005" --type="Service" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\ServiceDepNam001,Namespace1\\Namespace2\\ServiceDepNam002,Namespace1\\Namespace2\\Namespace3\\ServiceDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\ServiceDepNam004"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceDepNamExtends001" --type="Service" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceDepNamExtends002" --type="Service" --namespace="Namespace1\\Namespace2" --extends="Namespace1\\ServiceDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceDepNamExtends003" --type="Service" --namespace="Namespace1\\Namespace2\\Namespace3" --extends="Namespace1\\ServiceDepNam001" --dependency="Namespace1\\Namespace2\\ServiceDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceDepNamExtends004" --type="Service" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4" --extends="Namespace1\\ServiceDepNam001"  --dependency="Namespace1\\Namespace2\\ServiceDepNam002,Namespace1\\Namespace2\\Namespace3\\ServiceDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ServiceDepNamExtends005" --type="Service" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --extends="Namespace1\\ServiceDepNam001" --dependency="Namespace1\\Namespace2\\ServiceDepNam002,Namespace1\\Namespace2\\Namespace3\\ServiceDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\ServiceDepNam004"

cd $modulePath && ant dev && exit 1

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoRepository" --type="Repository" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoForm" --type="Form" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFilter" --type="Filter" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFactory" --type="Factory" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoValueObject" --type="ValueObject" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoControllerPlugin" --type="ControllerPlugin" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoViewHelper" --type="ViewHelper" --namespace="Minimo"


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