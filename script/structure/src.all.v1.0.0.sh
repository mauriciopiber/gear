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




cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Repository001" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Repository002" --type="Repository" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Repository003" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Repository004" --type="Repository" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Repository005" --type="Repository"  


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactory001" --type="Repository" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactory002" --type="Repository" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactory003" --type="Repository" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactory004" --type="Repository" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactory005" --type="Repository" --service="factories"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactoryNamespace001" --type="Repository" --service="factories" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactoryNamespace002" --type="Repository" --service="factories" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactoryNamespace003" --type="Repository" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactoryNamespace004" --type="Repository" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactoryNamespace005" --type="Repository" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryNamespace001" --type="Repository" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryNamespace002" --type="Repository" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryNamespace003" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryNamespace004" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryNamespace005" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNam001" --type="Repository" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNam002" --type="Repository" --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\RepositoryDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNam003" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\RepositoryDepNam001,Namespace1\\Namespace2\\RepositoryDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNam004" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\RepositoryDepNam001,Namespace1\\Namespace2\\RepositoryDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNam005" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\RepositoryDepNam001,Namespace1\\Namespace2\\RepositoryDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\RepositoryDepNam004"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFacDepNam001" --type="Repository" --service=factories --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFacDepNam002" --type="Repository" --service=factories --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\RepositoryFacDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFacDepNam003" --type="Repository" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\RepositoryFacDepNam001,Namespace1\\Namespace2\\RepositoryFacDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFacDepNam004" --type="Repository" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\RepositoryFacDepNam001,Namespace1\\Namespace2\\RepositoryFacDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryFacDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFacDepNam005" --type="Repository" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\RepositoryFacDepNam001,Namespace1\\Namespace2\\RepositoryFacDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryFacDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\RepositoryFacDepNam004"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNamExtends001" --type="Repository" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNamExtends002" --type="Repository" --namespace="Namespace1\\Namespace2" --extends="Namespace1\\RepositoryDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNamExtends003" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3" --extends="Namespace1\\RepositoryDepNam001" --dependency="Namespace1\\Namespace2\\RepositoryDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNamExtends004" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4" --extends="Namespace1\\RepositoryDepNam001"  --dependency="Namespace1\\Namespace2\\RepositoryDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNamExtends005" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --extends="Namespace1\\RepositoryDepNam001" --dependency="Namespace1\\Namespace2\\RepositoryDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\RepositoryDepNam004"


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


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelper001" --type="ViewHelper"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelper002" --type="ViewHelper" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelper003" --type="ViewHelper"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelper004" --type="ViewHelper" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelper005" --type="ViewHelper"  

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactory001" --type="ViewHelper" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactory002" --type="ViewHelper" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactory003" --type="ViewHelper" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactory004" --type="ViewHelper" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactory005" --type="ViewHelper" --service="factories"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactoryNamespace001" --type="ViewHelper" --service="factories" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactoryNamespace002" --type="ViewHelper" --service="factories" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactoryNamespace003" --type="ViewHelper" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactoryNamespace004" --type="ViewHelper" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactoryNamespace005" --type="ViewHelper" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperNamespace001" --type="ViewHelper" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperNamespace002" --type="ViewHelper" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperNamespace003" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperNamespace004" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperNamespace005" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNam001" --type="ViewHelper" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNam002" --type="ViewHelper" --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\ViewHelperDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNam003" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\ViewHelperDepNam001,Namespace1\\Namespace2\\ViewHelperDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNam004" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\ViewHelperDepNam001,Namespace1\\Namespace2\\ViewHelperDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNam005" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\ViewHelperDepNam001,Namespace1\\Namespace2\\ViewHelperDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\ViewHelperDepNam004"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFacDepNam001" --type="ViewHelper" --service=factories --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFacDepNam002" --type="ViewHelper" --service=factories --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\ViewHelperFacDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFacDepNam003" --type="ViewHelper" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\ViewHelperFacDepNam001,Namespace1\\Namespace2\\ViewHelperFacDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFacDepNam004" --type="ViewHelper" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\ViewHelperFacDepNam001,Namespace1\\Namespace2\\ViewHelperFacDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperFacDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFacDepNam005" --type="ViewHelper" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\ViewHelperFacDepNam001,Namespace1\\Namespace2\\ViewHelperFacDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperFacDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\ViewHelperFacDepNam004"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNamExtends001" --type="ViewHelper" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNamExtends002" --type="ViewHelper" --namespace="Namespace1\\Namespace2" --extends="Namespace1\\ViewHelperDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNamExtends003" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3" --extends="Namespace1\\ViewHelperDepNam001" --dependency="Namespace1\\Namespace2\\ViewHelperDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNamExtends004" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4" --extends="Namespace1\\ViewHelperDepNam001"  --dependency="Namespace1\\Namespace2\\ViewHelperDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNamExtends005" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --extends="Namespace1\\ViewHelperDepNam001" --dependency="Namespace1\\Namespace2\\ViewHelperDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\ViewHelperDepNam004"

cd $modulePath && ant unit
