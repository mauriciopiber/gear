#!/bin/bash

# MODULE
module=AllColumns
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





##########+=====================

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Form001" --type="Form"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Form002" --type="Form" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Form003" --type="Form"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Form004" --type="Form" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Form005" --type="Form"  



cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFactory001" --type="Form" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFactory002" --type="Form" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFactory003" --type="Form" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFactory004" --type="Form" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFactory005" --type="Form" --service="factories"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFactoryNamespace001" --type="Form" --service="factories" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFactoryNamespace002" --type="Form" --service="factories" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFactoryNamespace003" --type="Form" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFactoryNamespace004" --type="Form" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFactoryNamespace005" --type="Form" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormNamespace001" --type="Form" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormNamespace002" --type="Form" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormNamespace003" --type="Form" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormNamespace004" --type="Form" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormNamespace005" --type="Form" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormDepNam001" --type="Form" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormDepNam002" --type="Form" --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\FormDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormDepNam003" --type="Form" --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\FormDepNam001,Namespace1\\Namespace2\\FormDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormDepNam004" --type="Form" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\FormDepNam001,Namespace1\\Namespace2\\FormDepNam002,Namespace1\\Namespace2\\Namespace3\\FormDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormDepNam005" --type="Form" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\FormDepNam001,Namespace1\\Namespace2\\FormDepNam002,Namespace1\\Namespace2\\Namespace3\\FormDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\FormDepNam004"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFacDepNam001" --type="Form" --service=factories --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFacDepNam002" --type="Form" --service=factories --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\FormFacDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFacDepNam003" --type="Form" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\FormFacDepNam001,Namespace1\\Namespace2\\FormFacDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFacDepNam004" --type="Form" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\FormFacDepNam001,Namespace1\\Namespace2\\FormFacDepNam002,Namespace1\\Namespace2\\Namespace3\\FormFacDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormFacDepNam005" --type="Form" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\FormFacDepNam001,Namespace1\\Namespace2\\FormFacDepNam002,Namespace1\\Namespace2\\Namespace3\\FormFacDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\FormFacDepNam004"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormDepNamExtends001" --type="Form" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormDepNamExtends002" --type="Form" --namespace="Namespace1\\Namespace2" --extends="Namespace1\\FormDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormDepNamExtends003" --type="Form" --namespace="Namespace1\\Namespace2\\Namespace3" --extends="Namespace1\\FormDepNam001" --dependency="Namespace1\\Namespace2\\FormDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormDepNamExtends004" --type="Form" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4" --extends="Namespace1\\FormDepNam001"  --dependency="Namespace1\\Namespace2\\FormDepNam002,Namespace1\\Namespace2\\Namespace3\\FormDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FormDepNamExtends005" --type="Form" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --extends="Namespace1\\FormDepNam001" --dependency="Namespace1\\Namespace2\\FormDepNam002,Namespace1\\Namespace2\\Namespace3\\FormDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\FormDepNam004"

cd $modulePath && ant dev && exit 1
