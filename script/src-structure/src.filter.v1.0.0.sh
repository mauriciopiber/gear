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
#===========================================


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Filter001" --type="Filter"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Filter002" --type="Filter" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Filter003" --type="Filter"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Filter004" --type="Filter" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Filter005" --type="Filter"  

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFactory001" --type="Filter" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFactory002" --type="Filter" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFactory003" --type="Filter" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFactory004" --type="Filter" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFactory005" --type="Filter" --service="factories"



cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFactoryNamespace001" --type="Filter" --service="factories" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFactoryNamespace002" --type="Filter" --service="factories" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFactoryNamespace003" --type="Filter" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFactoryNamespace004" --type="Filter" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFactoryNamespace005" --type="Filter" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterNamespace001" --type="Filter" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterNamespace002" --type="Filter" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterNamespace003" --type="Filter" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterNamespace004" --type="Filter" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterNamespace005" --type="Filter" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterDepNam001" --type="Filter" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterDepNam002" --type="Filter" --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\FilterDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterDepNam003" --type="Filter" --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\FilterDepNam001,Namespace1\\Namespace2\\FilterDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterDepNam004" --type="Filter" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\FilterDepNam001,Namespace1\\Namespace2\\FilterDepNam002,Namespace1\\Namespace2\\Namespace3\\FilterDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterDepNam005" --type="Filter" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\FilterDepNam001,Namespace1\\Namespace2\\FilterDepNam002,Namespace1\\Namespace2\\Namespace3\\FilterDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\FilterDepNam004"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFacDepNam001" --type="Filter" --service=factories --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFacDepNam002" --type="Filter" --service=factories --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\FilterFacDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFacDepNam003" --type="Filter" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\FilterFacDepNam001,Namespace1\\Namespace2\\FilterFacDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFacDepNam004" --type="Filter" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\FilterFacDepNam001,Namespace1\\Namespace2\\FilterFacDepNam002,Namespace1\\Namespace2\\Namespace3\\FilterFacDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterFacDepNam005" --type="Filter" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\FilterFacDepNam001,Namespace1\\Namespace2\\FilterFacDepNam002,Namespace1\\Namespace2\\Namespace3\\FilterFacDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\FilterFacDepNam004"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterDepNamExtends001" --type="Filter" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterDepNamExtends002" --type="Filter" --namespace="Namespace1\\Namespace2" --extends="Namespace1\\FilterDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterDepNamExtends003" --type="Filter" --namespace="Namespace1\\Namespace2\\Namespace3" --extends="Namespace1\\FilterDepNam001" --dependency="Namespace1\\Namespace2\\FilterDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterDepNamExtends004" --type="Filter" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4" --extends="Namespace1\\FilterDepNam001"  --dependency="Namespace1\\Namespace2\\FilterDepNam002,Namespace1\\Namespace2\\Namespace3\\FilterDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FilterDepNamExtends005" --type="Filter" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --extends="Namespace1\\FilterDepNam001" --dependency="Namespace1\\Namespace2\\FilterDepNam002,Namespace1\\Namespace2\\Namespace3\\FilterDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\FilterDepNam004"

cd $modulePath && ant dev
exit 1